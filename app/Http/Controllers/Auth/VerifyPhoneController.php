<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Crypt;
use Twilio\Exceptions\ConfigurationException;

class VerifyPhoneController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedPhone()) return redirect()->route('home');

        $request->validate([
            'code' => ['required', 'numeric'],
        ]);
        
        if ($request->code === Crypt::decryptString(auth()->user()->phone_verify_code)) {
            $secondsOfValidation = (int) config('phone.seconds_of_validation');
            
            if ($secondsOfValidation > 0 && $request->user()->phone_verify_code_sent_at->diffInSeconds() > $secondsOfValidation) {       
                $this->sendOTP($request);

                return back()->with(['error' => 'Kode ini sudah kedaluwarsa, kode baru telah dikirimkan.']);
            }else {
                $request->user()->markPhoneAsVerified();
                
                return redirect()->route('home')->with(['messages' => __('phone.verified')]);
            }
        }
        
        if (config('phone.max_attempts') > 0) {

            if ($request->user()->phone_attempts_left <= 1) {
                if($request->user()->phone_attempts_left == 1) $request->user()->decrement('phone_attempts_left');
                
                // Check how many seconds left to get unbanned after no more attempts left
                $seconds_left = (int) config('phone.attempts_ban_seconds') - $request->user()->phone_last_attempt_date->diffInSeconds();
                
                $time_left = $seconds_left < 3600 ? floor($seconds_left / 60) . ' menit.' : floor($seconds_left / 3600) . ' jam.';
                
                if ($seconds_left > 0) {
                    return back()->with(['error' => 'Anda sudah melakukan 10 kali kesalahan. Silahkan coba lagi dalam ' . $time_left]);
                }

                // Send new code and set new attempts when user is no longer banned
                $this->sendOTP($request); 

                return back()->with(['error' => 'Kode baru telah dikirimkan, silahkan coba lagi.']);
            }

            $request->user()->decrement('phone_attempts_left');
            $request->user()->update(['phone_last_attempt_date' => now()]);
        }

        return back()->with(['error' => 'Kode yang kamu masukkan salah.']);
    }

    private function sendOTP(Request $request)
    {
        // Check how many seconds left to get unbanned after no more requests left
        if ($request->user()->otp_requests_left < 1) {
            $seconds_left = (int) config('phone.requests_ban_seconds') - $request->user()->phone_verify_code_sent_at->diffInSeconds();
                
            $time_left = $seconds_left < 3600 ? floor($seconds_left / 60) . ' menit.' : floor($seconds_left / 3600) . ' jam.';

            if ($seconds_left > 0) {
                return back()->with(['error' => 'Permintaan kode OTP sudah mencapai limit. Silahkan coba lagi dalam ' . $time_left]);
            }
        }

        $request->user()->sendPhoneVerificationNotification(true);

        $request->user()->decrement('otp_requests_left');
    }
}