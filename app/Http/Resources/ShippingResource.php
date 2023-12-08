<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order' => OrderResource::make($this->whenLoaded('order')),
            'code' => $this->code,
            'awb_no' => $this->awb_no,
            'send_start_time' => $this->send_start_time,
            'send_end_time' => $this->send_end_time,
        ];
    }
}
