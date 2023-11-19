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

    'max_attempts' => env('PHONE_MAX_ATTEMPTS', 3)?:0,

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
    | Seconds of ban when no attempts left (default 10 minutes).
    |
    */

    'attempts_ban_seconds' => env('PHONE_ATTEMPTS_BAN_SEOCNDS', 600)?:0,

];
