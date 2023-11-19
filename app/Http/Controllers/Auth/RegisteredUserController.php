<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
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
            'first_name' => 'required|string',
            'last_name' => 'string',
            'phone' => 'required|string|max:15',
        ]);

        if (preg_match('/^62/', $request->phone)) {
            $phone = '+62' . substr($request->phone, 2);
        } elseif (preg_match('/^0/', $request->phone)) {
            $phone = '+62' . substr($request->phone, 1);
        } else {
            $phone = '+62' . $request->phone;
        }
        
        $user = User::create([
            'role_id' => 1,
            'first_name' => ucwords($request->first_name),
            'last_name' => ucwords($request->last_name),
            'phone' => $phone,
        ]);
        
        event(new Registered($user));
        
        Auth::login($user);

        return redirect()->route('verification-phone.notice');
    }
}
