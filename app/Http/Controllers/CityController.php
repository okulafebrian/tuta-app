<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Models\City;


class CityController extends Controller
{   
    public function load($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->get();

        return response()->json([
            "cities" => CityResource::collection($cities)
        ]);
    }
}
