<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the user login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/User/Login', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {      
        $request->validate([
            'phone' => 'required|string|max:15',
        ]);

        if (preg_match('/^62/', $request->phone)) {
            $phone = '+62' . substr($request->phone, 2);
        } elseif (preg_match('/^0/', $request->phone)) {
            $phone = '+62' . substr($request->phone, 1);
        } else {
            $phone = '+62' . $request->phone;
        }
        
        $user = User::where('phone', $phone)->first();
        
        if (!$user) {
            return redirect()->route('register');
        }

        $user->forceFill([
            'phone_verified_at' => null,
        ])->save();
        
        $user->sendPhoneVerificationNotification(true);
        
        Auth::login($user);

        return redirect()->route('verification-phone.notice');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
