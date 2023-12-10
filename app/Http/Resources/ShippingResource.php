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
            'des_code' => $this->des_code,
            'send_start_time' => $this->send_start_time,
            'send_end_time' => $this->send_end_time,
            'formatted_etd_time' => $this->formatted_etd_time
        ];
    }
}
