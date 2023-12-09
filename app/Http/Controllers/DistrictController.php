<?php

namespace App\Http\Controllers;

use App\Http\Resources\DistrictResource;
use App\Models\District;


class DistrictController extends Controller
{
    public function load($cityId)
    {
        $districts = District::where('city_id', $cityId)->get();

        return response()->json([
            "districts" => DistrictResource::collection($districts)
        ]);
    }
}
