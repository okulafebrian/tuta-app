<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shoe;
use App\Models\ShoeVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index()
    {
        $search = request('search');
        
        $shoes = Shoe::with('category')
                ->where('name' , 'LIKE', '%' . $search . '%')
                ->get();

        foreach ($shoes as $shoe) {
            $shoe['mainPhoto'] = $shoe->getMainPhoto();
        }
        
        return inertia('Shop/Index', [
            'shoes' => $shoes,
            'search' => $search
        ]);
    }

    public function category(Category $category)
    {
        $shoes = $category->shoes;
        
        foreach ($shoes as $shoe) {
            $shoe['mainPhoto'] = $shoe->getMainPhoto();
        }
        
        return inertia('Shop/Category', [
            'shoes' => $shoes,
            'category' => $category
        ]);
    }
    

    public function shoe(Category $category, Shoe $shoe) {
        $photos = [];

        $mainPath = 'public/shoes/' . $shoe->code . '/'. $shoe->photo .'/';
        $mainFiles = Storage::files($mainPath);

        foreach ($mainFiles as $mainFile) {
            $photos[] = [
                'name' => pathinfo($mainFile, PATHINFO_FILENAME),
                'path' => asset(Storage::url($mainFile)),
            ];
        }
        
        foreach ($shoe->variantPhotos as $variantPhoto) {
            $colorPath = 'public/shoes/' . $shoe->code . '/' . $variantPhoto->photo;
            
            $photos[] = [
                'name' => $variantPhoto->color_id,
                'path' => asset(Storage::url($colorPath)),
            ];
        }
        
        $shoe->photos = $photos;
        
        foreach($shoe->shoeVariants as $shoeVariant) {
            $stocks[$shoeVariant->color_id][$shoeVariant->size_id] = $shoeVariant->stock;
        }
        
        $colors = DB::table('colors')
                    ->join('shoe_variants', 'colors.id', 'shoe_variants.color_id')
                    ->select('colors.id', 'colors.name')
                    ->selectRaw('SUM(shoe_variants.stock) AS total_stock')
                    ->where('shoe_variants.shoe_id', $shoe->id)
                    ->groupBy('colors.id', 'colors.name')
                    ->get();
        
        $sizes = DB::table('sizes')
                    ->join('shoe_variants', 'sizes.id', 'shoe_variants.size_id')
                    ->select('sizes.id', 'sizes.name')
                    ->selectRaw('SUM(shoe_variants.stock) AS total_stock')
                    ->where('shoe_variants.shoe_id', $shoe->id)
                    ->groupBy('sizes.id', 'sizes.name')
                    ->get();
        
        $color1 = $colors->where('total_stock', '>', 0)->first();
        $size1 = array_filter($stocks[$color1->id], function ($value) {
                        return $value > 0;
                    });
                    
        return inertia('Shop/Shoe', [
            'shoe' => $shoe->load('category', 'colors', 'sizes'),
            'stocks' => $stocks,
            'colors' => $colors,
            'sizes' => $sizes,
            'totalStock' => $shoe->shoeVariants->sum('stock'),
            'color1' => $color1->id,
            'size1' => key($size1),
        ]);
    }
}
