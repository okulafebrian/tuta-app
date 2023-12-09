<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ColorResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin.auth']);
    }
    
    public function index()
    {
        $search = request('search');

        $products = Product::where('name' , 'LIKE', '%' . $search . '%')
                    ->paginate(12);
        
        return inertia('Products/Index', [
            'products' => ProductResource::collection($products)
        ]);
    }

    public function manageDiscount()
    {
        $products = Product::all();
        
        return inertia('Products/Discount', [
            'products' => ProductResource::collection($products)
        ]);
    }

    public function create()
    {
        return inertia('Products/Create', [
            'categories' => Category::all(),
            'colors' => Color::all(),
            'sizes' => Size::all(),
        ]);
    }

    public function store(ProductRequest $request)
    {
        if (count($request->file('variant_photos')) != count($request->colors)) {
            return back();
        }
        
        DB::transaction(function () use($request) {
            $code = rand(1000, 9999);

            $currentTime = time();

            $path = 'public/products/' . $code;
            
            if ($request->file('main_photos')) {                
                foreach ($request->file('main_photos') as $index => $mainPhoto) {
                    $extension = $mainPhoto->getClientOriginalExtension();
                    $mainFileName = $currentTime + $index .'.' . $extension;
                    
                    $mainPhoto->storeAs($path . '/main', $mainFileName);
                }
            }
            
            $product = Product::create([
                'slug' => Str::of($request->name)->lower()->slug('-'),
                'category_id' => $request->category['id'],
                'code' => $code,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description
            ]);

            foreach($request->colors as $color) {
                $variantPhoto = $request->file("variant_photos.{$color['id']}");

                $variantFileName = null;
                
                if ($variantPhoto) {
                    $extension = $variantPhoto->getClientOriginalExtension();
                    $variantFileName = $currentTime + $color['id'] . '.' . $extension;
                    
                    $variantPhoto->storeAs($path, $variantFileName);
                }

                $sizes = Size::all();

                foreach($sizes as $size) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'size_id' => $size->id,
                        'color_id' => $color['id'],
                        'photo' => $variantFileName,
                        'stock' => $request->stocks[$color['id']][$size['id']] ?? 0,
                    ]);
                }
            }          
        });
        
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $variants = $product->variants;

        foreach ($variants as $variant) {
            $stocks[$variant->color_id][$variant->size_id] = $variant->stock;
        }
        
        return inertia('Products/Edit', [
            'product' => ProductResource::make($product),
            'categories' => CategoryResource::collection(Category::all()),
            'colors' => ColorResource::collection(Color::all()),
            'sizes' => Size::all(),
            'stocks' => $stocks
        ]);
    }

    public function update(Request $request, Product $product)
    {   
        $variantPhotoCount = count(array_filter($request->variant_photos, function ($photo) {
            return $photo !== null;
        }));
        
        if ($variantPhotoCount != count($request->colors)) {
            return back();
        }
        
        DB::transaction(function () use($request, $product) {
            $currentTime = time();

            $path = 'public/products/' . $product->code;

            $oldMainPhotos = array_map('basename', Storage::files($path . '/main/'));
            $mainPhotos = array_column($request->main_photos, 'name');
            $deletedMainPhotos = array_diff($oldMainPhotos, $mainPhotos);
            
            if (!empty($deletedMainPhotos)) {
                foreach ($deletedMainPhotos as $deletedMainPhoto) {
                    Storage::delete($path . '/main/' . $deletedMainPhoto);
                }
            }

            if ($request->file('main_photos')) {                
                foreach ($request->file('main_photos') as $index => $mainPhoto) {
                    $extension = $mainPhoto->getClientOriginalExtension();
                    $mainFileName = $currentTime + $index .'.' . $extension;
                    
                    $mainPhoto->storeAs($path . '/main', $mainFileName);
                }
            }

            $product->update([
                'slug' => Str::of($request->name)->lower()->slug('-'),
                'category_id' => $request->category['id'],
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);

            $variants = [];
            $updatedVariants = [];
            $productVariants = ProductVariant::where('product_id', $product->id)->get();

            foreach ($productVariants as $productVariant) {
                $variants[$productVariant->color_id][$productVariant->size_id] = $productVariant;
            }

            foreach($request->colors as $color) {
                $variantPhoto = $request->file("variant_photos.{$color['id']}");
                
                $variantFileName = $variants[$color['id']][1]['photo'];
                
                if ($variantPhoto) {
                    $path = 'public/products/' . $product->code . '/';
                    
                    Storage::delete($path . $variantFileName);
                    
                    $extension = $variantPhoto->getClientOriginalExtension();
                    $variantFileName = $currentTime + $color['id'] . '.' . $extension;
                    
                    $variantPhoto->storeAs($path, $variantFileName);
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
                        $productVariant = ProductVariant::create([
                            'product_id' => $product->id,
                            'size_id' => $size['id'],
                            'color_id' => $color['id'],
                            'photo' => $variantFileName,
                            'stock' => $request->stocks[$color['id']][$size['id']]  ?? 0,
                        ]);

                        $updatedVariants[] = $productVariant->id;
                    }
                }
            }

            ProductVariant::where('product_id', $product->id)
                ->whereNotIn('id', $updatedVariants)
                ->delete();
        });

        return redirect()->route('products.index');
    }

    public function updateDiscount(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'discount_price' => 'required',
            'discount' => 'required',
            'is_discount' => 'required',
        ]);

        foreach ($request->product_id as $i => $product_id) {
            $product = Product::find($product_id);

            $product->update([
                'discount_price' => $request->discount_price[$i],
                'discount' => $request->discount[$i],
                'is_discount' => $request->is_discount[$i],
            ]);
        }

        return back()->with(['success' => 'Diskon berhasil disimpan.']);
    }

    public function destroy(Product $product)
    {
        $path = 'public/products/' . $product->code;
        
        Storage::deleteDirectory($path);

        $product->delete();

        return back()->with(['success' => 'Produk berhasil dihapus.']);
    }
}
