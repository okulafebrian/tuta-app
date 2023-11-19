<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Twilio\Exceptions\TwilioException;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Twilio\Exceptions\ConfigurationException;

class VerifyPhoneController extends Controller
{
    /**
     * Mark the authenticated user's phone as verified.
     */
    public function __invoke(Request $request)
    {   
        $request->validate([
            'code' => 'required|numeric',
        ]);
        
        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $verify_id = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($sid, $token);
        
        try {
            $verification =
            $twilio->verify->v2->services($verify_id)
            ->verificationChecks
            ->create([
                "to" => $request->user()->phone,
                "code" => $request->code
                ]
            );
        } catch (\Throwable $th) {
            return back()->with('failed', 'Kode OTP sudah kadaluarsa.');
        }

        if ($verification->valid) {
            $request->user()->markPhoneAsVerified();
            
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->with('failed', 'Kode OTP salah!');
    }
}