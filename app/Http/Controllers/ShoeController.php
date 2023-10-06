<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoeRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Shoe;
use App\Models\ShoeVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        
        return inertia('Shoes/Index', [
            'shoes' => Shoe::with('category')->get()
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();

        return inertia('Shoes/Create', [
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    public function store(ShoeRequest $request)
    {
        DB::transaction(function () use($request) {
            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                
                $folderName = Str::random(7);
                
                $path = 'public/shoes/' . $folderName;
                
                foreach ($photos as $photo) {
                    $originalFileName = $photo->getClientOriginalName();
                    $extension = $photo->getClientOriginalExtension();
                    $fileName = pathinfo($originalFileName, PATHINFO_FILENAME);
                    $newFileName = $fileName . '.' . $extension;
                    
                    $photo->storeAs($path, $newFileName);
                }
            }
            
            $shoe = Shoe::create([
                'category_id' => $request->category,
                'code' => $folderName,
                'name' => $request->name,
                'price' => $request->price ?? 0,
                'discount_price' => $request->discount_price ?? 0,
                'description' => $request->description ?? 0,
            ]);

            if($request->colors && $request->sizes) {
                foreach($request->colors as $color) {
                    foreach($request->sizes as $size) {
                        ShoeVariant::create([
                            'shoe_id' => $shoe->id,
                            'size_id' => $size['id'],
                            'color_id' => $color['id'],
                            'price' => $request->prices[$color['id']][$size['id']] ?? 0,
                            'discount_price' => $request->discount_prices[$color['id']][$size['id']] ?? 0,
                            'stock' => $request->stocks[$color['id']][$size['id']] ?? 0,
                        ]);
                    }
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
        
        $selectedSizes = DB::table('sizes')
                            ->join('shoe_variants', 'sizes.id', 'shoe_variants.size_id')
                            ->select('sizes.id', 'sizes.name')
                            ->groupBy('sizes.id', 'sizes.name')
                            ->where('shoe_id', $shoe->id)
                            ->get();    
                     
        $variants = [];                    
        $prices = [];
        $discountPrices = [];
        $stocks = [];
        $shoeVariants = ShoeVariant::where('shoe_id', $shoe->id)->get();

        foreach ($shoeVariants as $shoeVariant) {
            $variants[$shoeVariant->color_id][$shoeVariant->size_id] = $shoeVariant->id;
            $prices[$shoeVariant->color_id][$shoeVariant->size_id] = $shoeVariant->price;
            $discountPrices[$shoeVariant->color_id][$shoeVariant->size_id] = $shoeVariant->discount_price;
            $stocks[$shoeVariant->color_id][$shoeVariant->size_id] = $shoeVariant->stock;
        }
        
        return inertia('Shoes/Edit', [
            'shoe' => $shoe,
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
            'selectedColors' => $selectedColors,
            'selectedSizes' => $selectedSizes,
            'variants' => $variants,
            'prices' => $prices,
            'discountPrices' => $discountPrices,
            'stocks' => $stocks
        ]);
    }

    public function update(ShoeRequest $request, Shoe $shoe)
    {   
        DB::transaction(function () use($request, $shoe) {
            $shoe->update([
                'category_id' => $request->category,
                'name' => $request->name,
                'price' => $request->price ?? 0,
                'discount_price' => $request->discount_price ?? 0,
                'description' => $request->description ?? 0,
            ]);

            $variants = [];
            $updatedVariants = [];
            $shoeVariants = ShoeVariant::where('shoe_id', $shoe->id)->get();

            foreach ($shoeVariants as $shoeVariant) {
                $variants[$shoeVariant->color_id][$shoeVariant->size_id] = $shoeVariant;
            }

            if($request->colors && $request->sizes) {
                foreach($request->colors as $color) {
                    foreach($request->sizes as $size) {
                        if(isset($variants[$color['id']][$size['id']])) {
                            $variants[$color['id']][$size['id']]->update([
                                'price' => $request->prices[$color['id']][$size['id']] ?? 0,
                                'discount_price' => $request->discount_prices[$color['id']][$size['id']] ?? 0,
                                'stock' => $request->stocks[$color['id']][$size['id']] ?? 0,
                            ]);

                            $updatedVariants[] = $variants[$color['id']][$size['id']]->id;
                        } else{
                            $shoeVariant = ShoeVariant::create([
                                'shoe_id' => $shoe->id,
                                'size_id' => $size['id'],
                                'color_id' => $color['id'],
                                'price' => $request->prices[$color['id']][$size['id']] ?? 0,
                                'discount_price' => $request->discount_prices[$color['id']][$size['id']] ?? 0,
                                'stock' => $request->stocks[$color['id']][$size['id']] ?? 0,
                            ]);

                            $updatedVariants[] = $shoeVariant->id;
                        }
                    }
                }
            }

            ShoeVariant::where('shoe_id', $shoe->id)
            ->whereNotIn('id', $updatedVariants)
            ->delete();
        });

        return redirect()->back();
    }

    public function updatePhoto(Request $request)
    {        
        if ($request->hasFile('photos')) {
            $path = 'public/shoes/' . $request->code;
            
            Storage::delete($path);
            
            $photos = $request->file('photos');
            
            foreach ($photos as $photo) {
                $originalFileName = $photo->getClientOriginalName();
                $extension = $photo->getClientOriginalExtension();
                $fileName = pathinfo($originalFileName, PATHINFO_FILENAME);
                $newFileName = $fileName . '.' . $extension;
                
                $photo->storeAs($path, $newFileName);
            }
        }
        
        return redirect()->back();
    }

    public function destroy(Shoe $shoe)
    {
        //
    }
}
