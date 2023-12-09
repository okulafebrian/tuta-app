<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;


class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware(['user.auth', 'verified.phone']);
    }
    
    public function index()
    {
        return inertia('Addresses/Index', [
            'addresses' => AddressResource::collection(auth()->user()->addresses),
            'mainAddress' => AddressResource::make(auth()->user()->mainAddress)
        ]);
    }

    public function store(AddressRequest $request)
    {        
        if ($request->is_main) {
            $mainAddress = auth()->user()->mainAddress;

            if ($mainAddress) {
                $mainAddress->update([
                    'is_main' => 0
                ]);
            }
        }
        
        Address::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'phone_number' => formatPhoneNumber($request->phone_number),
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'zip_code_id' => $request->zip_code_id,
            'detail' => $request->detail,
            'is_main' => $request->is_main
        ]);

        return back()->with(['success' => 'Alamat berhasil ditambahkan.']);
    }

    public function update(AddressRequest $request, Address $address)
    { 
        $address->update([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'phone_number' => formatPhoneNumber($request->phone_number),
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'zip_code_id' => $request->zip_code_id,
            'detail' => $request->detail,
        ]);
        
        return back()->with(['success' => 'Alamat lengkap berhasil disimpan.']);
    }

    public function updateMain(Address $address)
    {
        $currentMainAddress = auth()->user()->mainAddress;        
        
        $currentMainAddress->update([
            'is_main' => 0
        ]);

        $address->update([
            'is_main' => 1
        ]);

        return back()->with(['success' => 'Alamat utama berhasil disimpan.']);
    }

    public function destroy(Address $address)
    {
        if ($address->is_main) {
            return back()->with(['error' => 'Alamat utama tidak bisa dihapus.']);
        }

        $address->delete();

        return back()->with(['success' => 'Alamat berhasil dihapus.']);
    }
}
