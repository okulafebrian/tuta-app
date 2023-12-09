<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['user.auth', 'verified.phone']);
        $this->middleware('restriction.phone')->only('updatePhone');
    }
    
    public function index()
    {
        return inertia('Account');
    }

    public function updateName(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        return back()->with(['success' => 'Nama lengkap berhasil disimpan.']);;
    }

    public function updatePhone(Request $request, User $user)
    {
        $request->validate([
            'phone_number' => 'required'
        ]);

        if ($user->phone_number == $request->phone_number) {
            return back();
        }
        
        $user->update([
            'phone_number' => formatPhoneNumber($request->phone_number),
            'phone_last_update_date' => now(),
            'phone_verified_at' => null
        ]);

        $user->sendPhoneVerificationNotification(true);

        return redirect()->route('verification-phone.notice');
    }
}
