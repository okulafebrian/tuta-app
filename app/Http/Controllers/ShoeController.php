<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoeRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Shoe;
use App\Models\ShoeVariant;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin.auth']);
    }
    
    public function index()
    {
        $search = request('search');

        $shoes = Shoe::with('category')
                    ->where('name' , 'LIKE', '%' . $search . '%')
                    ->paginate(5);

        foreach ($shoes as $shoe) {
            $shoe['mainPhoto'] = $shoe->getMainPhoto();
        }
        
        return inertia('Shoes/Index', [
            'shoes' => $shoes
        ]);
    }

    public function manageDiscount()
    {
        $shoes = Shoe::with('category')->get();

        foreach ($shoes as $shoe) {
            $shoe['mainPhoto'] = $shoe->getMainPhoto();
        }
        
        return inertia('Shoes/Discount', [
            'shoes' => $shoes
        ]);
    }

    public function create()
    {
        return inertia('Shoes/Create', [
            'categories' => Category::all(),
            'colors' => Color::all(),
            'sizes' => Size::all(),
        ]);
    }

    public function store(ShoeRequest $request)
    {
        if (count($request->file('variant_photos')) != count($request->colors)) {
            return redirect()->back();
        }

        DB::transaction(function () use($request) {
            $code = rand(1000, 9999);

            $currentTime = time();

            $mainFolderName = null;
            
            if ($request->file('main_photos')) {
                $mainFolderName = 'main';

                $path = 'public/shoes/' . $code . '/' . $mainFolderName .'/';
                
                foreach ($request->file('main_photos') as $index => $mainPhoto) {
                    $extension = $mainPhoto['item']->getClientOriginalExtension();
                    $mainFileName = $currentTime + $index .'.' . $extension;
                    
                    $mainPhoto['item']->storeAs($path, $mainFileName);
                }
            }
            
            $shoe = Shoe::create([
                'slug' => Str::of($request->name)->lower()->slug('-'),
                'category_id' => $request->category,
                'code' => $code,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'photo' => $mainFolderName,
            ]);

            foreach($request->colors as $color) {
                $variantPhoto = $request->file("variant_photos.{$color['id']}");

                $variantFileName = null;
                
                if ($variantPhoto) {
                    $path = 'public/shoes/' . $code;
                    
                    $extension = $variantPhoto['item']->getClientOriginalExtension();
                    $variantFileName = $currentTime + $color['id'] . '.' . $extension;
                    
                    $variantPhoto['item']->storeAs($path, $variantFileName);
                }

                $sizes = Size::all();

                foreach($sizes as $size) {
                    ShoeVariant::create([
                        'shoe_id' => $shoe->id,
                        'size_id' => $size->id,
                        'color_id' => $color['id'],
                        'photo' => $variantFileName,
                        'stock' => $request->stocks[$color['id']][$size['id']],
                    ]);
                }
            }          
        });
        
        return redirect()->route('shoes.index');
    }

    public function show(Shoe $shoe)
    {
        //
    }

    public function edit(Shoe $shoe)
    {
        $categories = Category::all();
        $colors = Color::select('id', 'name')->get();
        $sizes = Size::select('id', 'name')->get();

        $selectedColors = DB::table('colors')
                            ->join('shoe_variants', 'colors.id', 'shoe_variants.color_id')
                            ->select('colors.id', 'colors.name')
                            ->groupBy('colors.id', 'colors.name')
                            ->where('shoe_id', $shoe->id)
                            ->get();      
        
        $path = public_path('storage/shoes/' . $shoe->code . '/main/');

        $files = File::files($path);

        $mainPhotos = [];
        foreach ($files as $file) {
            $mainPhotos[] = $file->getFilename();
        }
        
        $stocks = [];
        $shoeVariants = ShoeVariant::where('shoe_id', $shoe->id)->get();
        $variantPhotos = [];

        foreach ($shoeVariants as $index => $shoeVariant) {
            $variantPhotos[$shoeVariant->color_id] = $shoeVariant->photo;
            $stocks[$shoeVariant->color_id][$shoeVariant->size_id] = $shoeVariant->stock;
        }
        
        return inertia('Shoes/Edit', [
            'shoe' => $shoe,
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
            'selectedColors' => $selectedColors,
            'stocks' => $stocks,
            'mainPhotos' => $mainPhotos,
            'variantPhotos' => $variantPhotos
        ]);
    }

    public function update(ShoeRequest $request, Shoe $shoe)
    {   
        DB::transaction(function () use($request, $shoe) {
            $currentTime = time();

            $mainFolderName = $shoe->photo;

            $shoe->update([
                'category_id' => $request->category,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'photo' => $mainFolderName
            ]);

            $variants = [];
            $updatedVariants = [];
            $shoeVariants = ShoeVariant::where('shoe_id', $shoe->id)->get();

            foreach ($shoeVariants as $shoeVariant) {
                $variants[$shoeVariant->color_id][$shoeVariant->size_id] = $shoeVariant;
            }
            
            foreach($request->colors as $color) {
                $variantPhoto = $request->file("variant_photos.{$color['id']}");

                $variantFileName = $variants[$color['id']][1]['photo'];
                
                if ($variantPhoto) {
                    $path = 'public/shoes/' . $shoe->code . '/';
                    
                    Storage::delete($path . $variantFileName);
                    
                    $extension = $variantPhoto['item']->getClientOriginalExtension();
                    $variantFileName = $currentTime + $color['id'] . '.' . $extension;
                    
                    $variantPhoto['item']->storeAs($path, $variantFileName);
                }
                
                $sizes = Size::all();

                foreach($sizes as $size) {
                    if(isset($variants[$color['id']][$size['id']])) {
                        $variants[$color['id']][$size['id']]->update([
                            'photo' => $variantFileName,
                            'stock' => $request->stocks[$color['id']][$size['id']],
                        ]);

                        $updatedVariants[] = $variants[$color['id']][$size['id']]->id;
                    } else{
                        $shoeVariant = ShoeVariant::create([
                            'shoe_id' => $shoe->id,
                            'size_id' => $size['id'],
                            'color_id' => $color['id'],
                            'photo' => $variantFileName,
                            'stock' => $request->stocks[$color['id']][$size['id']],
                        ]);

                        $updatedVariants[] = $shoeVariant->id;
                    }
                }
            }

            ShoeVariant::where('shoe_id', $shoe->id)
                ->whereNotIn('id', $updatedVariants)
                ->delete();
        });

        return redirect()->back();
    }

    public function updateDiscount(Request $request)
    {
        $request->validate([
            'shoe_id' => 'required',
            'discount_price' => 'required',
            'discount' => 'required',
            'is_discount' => 'required',
        ]);

        foreach ($request->shoe_id as $i => $shoe_id) {
            $shoe = Shoe::find($shoe_id);

            $shoe->update([
                'discount_price' => $request->discount_price[$i],
                'discount' => $request->discount[$i],
                'is_discount' => $request->is_discount[$i],
            ]);
        }

        return redirect()->back();
    }

    public function destroy(Shoe $shoe)
    {
        $path = 'public/shoes/' . $shoe->code;
        
        Storage::deleteDirectory($path);

        $shoe->delete();

        return redirect()->back();
    }
}
