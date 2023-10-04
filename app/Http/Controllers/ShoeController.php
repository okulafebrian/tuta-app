<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Shoe;
use App\Models\ShoeVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use($request) {
            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                
                $folderName = Str::random(7); // You can adjust the length as needed
                
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
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'description' => $request->description,
            ]);

            foreach($request->colors as $color) {
                foreach($request->sizes as $size) {
                    ShoeVariant::create([
                        'shoe_id' => $shoe->id,
                        'size_id' => $size['id'],
                        'color_id' => $color['id'],
                        'price' => $request->prices[$color['id']][$size['id']],
                        'discount_price' => $request->discount_prices[$color['id']][$size['id']],
                        'stock' => $request->stocks[$color['id']][$size['id']],
                    ]);
                }
            }
        });

        return redirect()->route('shoes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shoe $shoe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shoe $shoe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shoe $shoe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shoe $shoe)
    {
        //
    }
}
