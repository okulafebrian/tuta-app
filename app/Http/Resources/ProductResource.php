<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {           
        $colors = $this->colors;
        if (Route::currentRouteName() === 'shop.product') {
            foreach ($colors as $color) {
                $color->total_stock = $this->getStockByColor($color->id);
            }
        }
        
        $sizes = $this->sizes;
        if (Route::currentRouteName() === 'shop.product') {
            foreach ($sizes as $size) {
                $size->total_stock = $this->getStockBySize($size->id);
            }
        }
        
        $mainPhotoNames = $this->mainPhotos();
        foreach ($mainPhotoNames as $mainPhotoName) {
            $main_photos[] = [
                'name' => $mainPhotoName,
                'url' => '/storage/products/' . $this->code . '/main/' . $mainPhotoName
            ];
        }

        $variantPhotoNames = $this->variantPhotos();
        foreach ($variantPhotoNames as $variantPhotoName) {
            $variant_photos[] = [
                'name' => $variantPhotoName,
                'url' => '/storage/products/' . $this->code . '/' . $variantPhotoName
            ];
        }

        $photos = array_merge($main_photos, $variant_photos);
        
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'slug' => $this->slug,
            'category' => CategoryResource::make($this->category),
            'price' => $this->price,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'discount' => $this->discount,
            'is_discount' => $this->is_discount,
            'is_active' => $this->is_active,
            'description' => $this->description,
            'photos' => $photos,
            'main_photos' => $main_photos,
            'variant_photos' => $variant_photos,
            'colors' => ColorResource::collection($colors),
            'sizes' => SizeResource::collection($sizes),
            'stock' => $this->getStock(),
            'description' => $this->description
        ];
    }
}
