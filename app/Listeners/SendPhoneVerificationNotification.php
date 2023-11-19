<?php

namespace App\Listeners;

use Twilio\Rest\Client;
use App\Interfaces\MustVerifyPhone;
use Illuminate\Auth\Events\Registered;
use Twilio\Exceptions\TwilioException;
use Twilio\Exceptions\ConfigurationException;

class SendPhoneVerificationNotification
{
    public function handle(Registered $event)
    {
        if ($event->user instanceof MustVerifyPhone && ! $event->user->hasVerifiedPhone()) {
            $event->user->sendPhoneVerificationNotification(true);
        }
    }
}
