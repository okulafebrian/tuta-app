<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->when(in_array($this->role_id, [2, 3]), $this->email),
            'phone_number' => $this->when($this->role_id === 1, $this->phone_number),
            'phone_last_update_date' => $this->when($this->role_id === 1, $this->phone_last_update_date),
        ];
    }
}
