<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware(['user.auth', 'verified.phone']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::with('district', 'city')
                        ->where('user_id', auth()->user()->id)->get();
        
        return inertia('Addresses/Index', [
            'addresses' => $addresses
        ]);
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
    public function store(AddressRequest $request)
    {        
        if (preg_match('/^62/', $request->phone)) {
            $phone = '+62' . substr($request->phone, 2);
        } elseif (preg_match('/^0/', $request->phone)) {
            $phone = '+62' . substr($request->phone, 1);
        } else {
            $phone = '+62' . $request->phone;
        }

        $mainAddress = Address::where('user_id', auth()->user()->id)
                        ->where('is_main', 1)
                        ->first();
        
        Address::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'phone' => $phone,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'zip_code_id' => $request->zip_code_id,
            'detail' => $request->detail,
            'is_main' => $request->is_main
        ]);

        if ($mainAddress) {
            $mainAddress->update(['is_main' => 0]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, Address $address)
    {
        if (preg_match('/^62/', $request->phone)) {
            $phone = '+62' . substr($request->phone, 2);
        } elseif (preg_match('/^0/', $request->phone)) {
            $phone = '+62' . substr($request->phone, 1);
        } else {
            $phone = '+62' . $request->phone;
        }
        
        $address->update([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'phone' => $phone,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'zip_code_id' => $request->zip_code_id,
            'detail' => $request->detail,
        ]);
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->back();
    }

    public function setMain(Address $address)
    {
        $mainAddress = Address::where('user_id', auth()->user()->id)
                        ->where('is_main', 1)
                        ->first();
            
        $address->update(['is_main' => 1]);

        if ($mainAddress) {
            $mainAddress->update(['is_main' => 0]);
        }

        return redirect()->back();
    }
}
