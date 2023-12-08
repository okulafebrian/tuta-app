<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\CollectionProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::withCount('collectionProducts')->paginate(12);
        
        return inertia('Collections/Index', [
            'collections' => $collections
        ]);
    }

    public function create()
    {
        $products = Product::with('category')->get();

        foreach ($products as $product) {
            $product['mainPhoto'] = $product->getMainPhoto();
        }

        return inertia('Collections/Create', [
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'products' => 'required'
        ]);

        $collection = Collection::create([
            'name' => $request->name,
            'slug' => Str::of($request->name)->lower()->slug('-'),
        ]);

        foreach ($request->products as $product) {
            $collectionProducts[] = [
                'collection_id' => $collection->id,
                'product_id' => $product['id'],
            ];
        }
        
        CollectionProduct::insert($collectionProducts);

        return redirect()->route('collections.index')->with(['success' => 'Koleksi baru berhasil ditambahkan.']);
    }

    public function edit(Collection $collection)
    {
        $products = Product::with('category')->get();

        foreach ($products as $product) {
            $product['mainPhoto'] = $product->getMainPhoto();
        }

        $collection->load('products', 'products.category');
        
        foreach ($collection->products as $product) {
            $product->mainPhoto = $product->getMainPhoto();
        }
        
        return inertia('Collections/Edit', [
            'collection' => $collection,
            'products' => $products
        ]);
    }

    public function destroy(Collection $collection)
    {
        //
    }
}
