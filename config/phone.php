<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Phone code max attempts
    |--------------------------------------------------------------------------
    |
    | Max attempts to input phone verification code before re-send a new one.
    | Set 0 for not use this feature.
    |
    */

    'max_attempts' => env('PHONE_MAX_ATTEMPTS', 5)?:0,

    /*
    |--------------------------------------------------------------------------
    | OTP max requests
    |--------------------------------------------------------------------------
    |
    | Max requests to get OTP code.
    | Set 0 for not use this feature.
    |
    */

    'max_requests' => env('OTP_MAX_REQUESTS', 5)?:0,

    /*
    |--------------------------------------------------------------------------
    | Phone seconds of validation
    |--------------------------------------------------------------------------
    |
    | Seconds of validation of the sent verification code (default 5 minutes).
    | Set 0 for not use this feature.
    |
    */

    'seconds_of_validation' => env('PHONE_SECONDS_OF_VALIDATION', 300)?:0,

    /*
    |--------------------------------------------------------------------------
    | Phone attempts ban seconds
    |--------------------------------------------------------------------------
    |
    | Seconds of ban when no attempts left (default 5 hours).
    |
    */

    'attempts_ban_seconds' => env('PHONE_ATTEMPTS_BAN_SEOCNDS', 18000)?:0,

    /*
    |--------------------------------------------------------------------------
    | OTP requests ban seconds
    |--------------------------------------------------------------------------
    |
    | Seconds of ban when no requests left (default 5 hours).
    |
    */

    'requests_ban_seconds' => env('OTP_REQUESTS_BAN_SEOCNDS', 18000)?:0,

];
