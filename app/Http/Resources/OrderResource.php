<?php

namespace App\Http\Resources;

use App\Models\District;
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
            'city' => CityResource::make($this->city),
            'district' => DistrictResource::make($this->district),
            'zip_code' => ZipCodeResource::make($this->zipCode),
            'created_at' => $this->created_at,
            'cancelled_at' => $this->cancelled_at,
            'formatted_created_at' => $this->formatted_created_at,
            'formatted_cancelled_at' => $this->formatted_cancelled_at,
            'paid_at' => $this->paid_at,
            'order_details' => OrderDetailResource::collection($this->orderDetails),
            'shipping' => ShippingResource::make($this->latestShipping()),
            'expired_due_time' => $this->expired_due_time,
            'redirect_url' => $this->redirect_url
        ];
    }
}
