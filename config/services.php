<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
    'midtrans' => [
        'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
        'client_key' => env('MIDTRANS_CLIENT_KEY'),
        'server_key' => env('MIDTRANS_SERVER_KEY'),
        'is_production' => ((bool) env('APP_ENV') != 'production'),
        'is_sanitized' => false,
        'is_3ds' => false,
    ],
    
    'jnt' => [
        'username' => env('JNT_USERNAME'),
        'api_key' => env('JNT_API_KEY'),
        'order_key' => env('JNT_ORDER_KEY'),
        'order_url' => env('JNT_ORDER_URL'),
        'tariff_check_key' => env('JNT_TARIFF_CHECK_KEY'),
        'tariff_check_url' => env('JNT_TARIFF_CHECK_URL'),
        'track_key' => env('JNT_TRACK_KEY'),
        'track_url' => env('JNT_TRACK_URL'),
        'cancel_key' => env('JNT_CANCEL_KEY'),
        'cancel_url' => env('JNT_CANCEL_URL'),
    ],

    'whatsapp' => [
        'api_key' => env('WA_API_KEY'),
    ]

];
