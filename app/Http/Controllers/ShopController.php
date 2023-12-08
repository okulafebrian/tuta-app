<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;


class ShopController extends Controller
{
    public function index()
    {        
        $products = Product::all();

        return inertia('Shop/Index', [
            'products' => ProductResource::collection($products)
        ]);
    }

    public function category(Category $category)
    {     
        return inertia('Shop/Category', [
            'products' => ProductResource::collection($category->products),
            'category' => $category
        ]);
    }
    
    public function product(Category $category, Product $product)
    {            
        $variants = $product->variants;

        foreach ($variants as $variant) {
            $stocks[$variant->color_id][$variant->size_id] = $variant->stock;
        }

        return inertia('Shop/Product', [
            'product' => ProductResource::make($product),
            'stocks' => $stocks
        ]);
    }
}
