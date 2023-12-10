<?php
 
namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

 
class AuthenticatedSessionController extends Controller
{
    public function create(): Response
    {
        return inertia('Auth/User/Login');
    }
    
    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'phone_number' => ['required', 'string', 'max:15'],
        ]);
        
        if ($this->attemptPhoneAuthentication(formatPhoneNumber($request->phone_number))) {
            $request->session()->regenerate();
 
            return redirect()->route('verification-phone.notice');
        }
        
        return back()->with(['error' => 'Nomor yang kamu masukkan belum terdaftar.']);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->user()->update([
            'phone_verified_at' => null
        ]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function attemptPhoneAuthentication($phoneNumber)
    {
        $user = User::where('phone_number', $phoneNumber)->first();

        if ($user) {
            $user->update([
                'phone_verified_at' => null
            ]);

            $user->sendPhoneVerificationNotification(true);
            
            Auth::login($user);
            
            return true;
        }

        return false;
    }
}