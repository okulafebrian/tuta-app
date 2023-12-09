<?php

namespace App\Http\Controllers;

use App\Http\Resources\CollectionResource;
use App\Http\Resources\ProductResource;
use App\Models\Collection;
use App\Models\Product;


class HomeController extends Controller
{
    public function __invoke()
    {
        $products = Product::all();

        $collection = Collection::where('name', 'Rekomendasi Kami')->first();
        
        return inertia('Home', [
            'products' => ProductResource::collection($products),
            'collection' => $collection ? CollectionResource::make($collection) : null
        ]);
    }

    public function about()
    {
        return inertia('About');
    }
}
