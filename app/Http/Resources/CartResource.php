<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product' => ProductResource::make($this->productVariant->product),
            'color' => ColorResource::make($this->productVariant->color),
            'size' => SizeResource::make($this->productVariant->size),
            'photo' => $this->productVariant->photo,
            'stock' => $this->productVariant->stock,
            'quantity' => $this->quantity
        ];
    }
}
