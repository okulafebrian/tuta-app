<?php

namespace App\Traits;

use App\Notifications\SendVerifySMS;
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
            'phone_verified_at' => $this->freshTimestamp(),
            // 'phone_attempts_left' => 0,
        ])->save();
    }

    public function sendPhoneVerificationNotification(bool $newData = false): void
    {
        if($newData)
        {
            // $this->phone_attempts_left = config('phone.max_attempts');
            // $this->phone_verify_code_sent_at = now();
        }
        
        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $verify_id = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($sid, $token);
        
        $verification = 
            $twilio->verify->v2->services($verify_id)
            ->verifications
            ->create($this->phone, "whatsapp", ["locale" => "id"]);
    }
}