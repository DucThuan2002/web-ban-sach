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

    
    'facebook' => [
        'client_id' => '1365451530811179',       // Client ID của ứng dụng Facebook của bạn
        'client_secret' => '38cb582420f3dce4519e7fbed24ced66',   // Client Secret của ứng dụng Facebook của bạn
        'redirect' => 'http://localhost/shop/admin/user/login/callback',   // URL callback trả về từ Facebook
    ],

    'google' => [
        'client_id' => '232004036280-8v0rgkdel1p3a80dieut2o0h2laa4dsr.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/shop/admin/user/login/google/callback',
    ],
    
    

];
