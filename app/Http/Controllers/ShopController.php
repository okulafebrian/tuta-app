<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index()
    {
        $shoes = Shoe::with('category')->get();
        
        foreach($shoes as $i => $shoe) {
            $directory = '/public/shoes/' . $shoe->code;
            $fileNames = collect(Storage::files($directory))
                        ->map(function($file){
                            return basename($file);
                        });
            $shoes[$i]->photos = $fileNames;
        }
        
        return inertia('Shop/Index', [
            'shoes' => $shoes
        ]);
    }
    
    public function category(Category $category) {
        $shoes = Shoe::where('category_id', $category->id)->with('category')->get();
        
        foreach($shoes as $i => $shoe) {
            $directory = '/public/shoes/' . $shoe->code;
            $fileNames = collect(Storage::files($directory))
                        ->map(function($file){
                            return basename($file);
                        });
            $shoes[$i]->photos = $fileNames;
        }
        
        return inertia('Shop/Category', [
            'category' => $category,
            'shoes' => $shoes
        ]);
    }

    public function shoe(Category $category, Shoe $shoe) {        
        $directory = '/public/shoes/' . $shoe->code;
        $fileNames = collect(Storage::files($directory))
                    ->map(function($file){
                        return basename($file);
                    });
        $shoe->photos = $fileNames;

        $colors = DB::table('colors')
                    ->join('shoe_variants', 'colors.id', 'shoe_variants.color_id')
                    ->join('shoes', 'shoe_variants.shoe_id', 'shoes.id')
                    ->where('shoes.id', $shoe->id)
                    ->select('colors.id', 'colors.name')
                    ->groupBy('colors.id', 'colors.name')
                    ->get();

        $sizes = DB::table('sizes')
                    ->join('shoe_variants', 'sizes.id', 'shoe_variants.size_id')
                    ->join('shoes', 'shoe_variants.shoe_id', 'shoes.id')
                    ->where('shoes.id', $shoe->id)
                    ->select('sizes.id', 'sizes.name')
                    ->groupBy('sizes.id', 'sizes.name')
                    ->get();
        
        return inertia('Shop/Shoe', [
            'shoe' => $shoe->load('category'),
            'colors' => $colors,
            'sizes' => $sizes
        ]);
    }
}
