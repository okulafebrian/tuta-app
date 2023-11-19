<?php

namespace App\Http\Controllers;

use App\Models\ZipCode;
use Illuminate\Http\Request;

class ZipCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ZipCode $zipCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ZipCode $zipCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ZipCode $zipCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ZipCode $zipCode)
    {
        //
    }

    public function load($districtId)
    {
        return response()->json([
            "zipCodes" => ZipCode::where('district_id', $districtId)->get()
        ]);
    }
}
