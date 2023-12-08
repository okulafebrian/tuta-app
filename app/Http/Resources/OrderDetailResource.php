<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'category' => $this->category,
            'size' => $this->size,
            'color' => $this->color,
            'price' => $this->price,
            'photo' => $this->photo,
            'quantity' => $this->quantity,
            'sub_total' => $this->sub_total,
        ];
    }
}
