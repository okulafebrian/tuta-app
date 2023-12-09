<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProvinceResource;
use App\Models\Province;

class ProvinceController extends Controller
{
    public function load()
    {
        return response()->json([
            'provinces' => ProvinceResource::collection(Province::all())
        ]);
    }
}
