<?php

namespace App\Traits;

use App\Notifications\SendVerifyWhatsApp;
use App\Services\Whatsapp\Whatsapp;
use Illuminate\Support\Facades\Crypt;
use Twilio\Rest\Client;

trait MustVerifyPhone
{
    public function hasVerifiedPhone(): bool
    {
        return ! is_null($this->phone_verified_at);
    }

    public function markPhoneAsVerified(): bool
    {
        return $this->forceFill([
            'phone_verify_code' => null,
            'phone_verified_at' => $this->freshTimestamp(),
            'phone_attempts_left' => 0,
            'otp_requests_left' => 0,
        ])->save();
    }

    public function sendPhoneVerificationNotification(bool $newData = false): void
    {
        if ($newData) {
            $this->forceFill([
                'phone_verify_code' => Crypt::encryptString(random_int(111111, 999999)),
                'phone_attempts_left' => config('phone.max_attempts'),
                'otp_requests_left' => config('phone.max_requests'),
                'phone_verify_code_sent_at' => now()
            ])->save();
        }

        $this->update(['phone_verify_code_sent_at' => now()]);
        
        $whatsapp = new Whatsapp();
        
        $response = $whatsapp->sendOTP($this->phone_number, Crypt::decryptString($this->phone_verify_code));
        
        if (isset($response['errors'])) {
            if ($response['errors'][0]['code'] == 1013) {
                throw new \Exception('Nomor Anda tidak valid.');
            }
        }
    }
}