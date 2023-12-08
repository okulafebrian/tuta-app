<?php

namespace App\Http\Controllers;

use App\Http\Resources\ZipCodeResource;
use App\Models\ZipCode;
use Illuminate\Http\Request;

class ZipCodeController extends Controller
{
    public function load($districtId)
    {
        $zipCodes = ZipCode::where('district_id', $districtId)->get();

        return response()->json([
            "zipCodes" => ZipCodeResource::collection($zipCodes)
        ]);
    }
}
