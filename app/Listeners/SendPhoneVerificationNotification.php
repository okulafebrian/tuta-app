<?php

namespace App\Listeners;

use App\Interfaces\MustVerifyPhone;
use Illuminate\Auth\Events\Registered;

class SendPhoneVerificationNotification
{
    public function handle(Registered $event)
    {
        if ($event->user instanceof MustVerifyPhone && ! $event->user->hasVerifiedPhone()) {
            $event->user->sendPhoneVerificationNotification(true);
        }
    }
}
