<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Twilio\Rest\Client;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/User/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string|max:15',
        ]);
        
        try {
            $user = User::create([
                'role_id' => 1,
                'name' => ucwords($request->name),
                'phone_number' => formatPhoneNumber($request->phone_number),
                'phone_last_update_date' => now(),
            ]);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                return back()->with(['error' => 'Nomor yang kamu masukkan sudah terdaftar.']);
            } 
        }
        
        event(new Registered($user));
        
        Auth::login($user);

        return redirect()->route('verification-phone.notice');
    }
}
