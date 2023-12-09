<?php

namespace App\Http\Resources;

use App\Http\Controllers\ProvinceController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'province' => ProvinceResource::make($this->province),
            'city' => CityResource::make($this->city),
            'district' => DistrictResource::make($this->district),
            'zip_code' => ZipCodeResource::make($this->zipCode),
            'detail' => $this->detail,
            'is_main' => $this->is_main,
        ];
    }
}
