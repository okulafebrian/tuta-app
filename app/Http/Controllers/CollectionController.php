<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionRequest;
use App\Http\Resources\CollectionResource;
use App\Http\Resources\ProductResource;
use App\Models\Collection;
use App\Models\CollectionProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::paginate(12);
        
        return inertia('Collections/Index', [
            'collections' => $collections
        ]);
    }

    public function create()
    {
        $products = Product::all();

        return inertia('Collections/Create', [
            'products' => ProductResource::collection($products)
        ]);
    }

    public function store(CollectionRequest $request)
    {
        

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

        return redirect()->route('collections.index')->with(['success' => 'Etalase baru berhasil ditambahkan.']);
    }

    public function edit(Collection $collection)
    {
        $products = Product::all();

        return inertia('Collections/Edit', [
            'collection' => CollectionResource::make($collection),
            'products' => ProductResource::collection($products)
        ]);
    }

    public function update(CollectionRequest $request, Collection $collection)
    {
        $newProductIds = collect($request->products)->pluck('id')->toArray();

        $collection->update([
            'name' => $request->name,
            'slug' => Str::of($request->name)->lower()->slug('-'),
        ]);
        
        $collection->products()->sync($newProductIds);

        return redirect()->route('collections.index')->with(['success' => 'Etalase berhasil disimpan.']);
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();

        return back()->with(['success' => 'Etalase berhasil dihapus.']);
    }
}
