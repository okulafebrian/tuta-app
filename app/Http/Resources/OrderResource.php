<?php

namespace App\Http\Resources;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'code' => $this->code,
            'status' => $this->status,
            'total_price' => $this->total_price,
            'shipping_fee' => $this->shipping_fee,
            'total_payment' => $this->total_payment,
            'total_quantity' => $this->total_quantity,
            'payment_type' => $this->payment_type,
            'receiver_name' => $this->receiver_name,
            'receiver_phone' => $this->receiver_phone,
            'receiver_address' => $this->receiver_address,
            'province' => $this->province->name,
            'city' => $this->city->name,
            'district' => $this->district->name,
            'zip_code' => $this->zipCode->name,
            'formatted_created_at' => $this->formatted_created_at,
            'paid_at' => $this->paid_at,
            'order_details' => OrderDetailResource::collection($this->orderDetails),
            'shipping' => ShippingResource::make($this->latestShipping())
        ];
    }
}
