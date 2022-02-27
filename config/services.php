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
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK__SECRET_KEY'),
        'redirect' => 'https://127.0.0.1:8000/facebook/callback/'
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE__SECRET_KEY'),
        'api_key' => env('GOOGLE_MAPS_API_KEY'),
        'redirect' => 'http://127.0.0.1:8000/google/callback/'
    ],

    'twitter' => [
        'handle' => env('TWITTER_HANDLE'),
    ],

    'nexmo' => [
            'key' => env('NEXMO_KEY'),
            'secret' => env('NEXMO_SECRET'),
    ],

    'paystack' => [
            'key' => env('PAYSTACK_PUBLIC_KEY'),
            'secret' => env('PAYSTACK_SECRET_KEY'),
    ],

    'rave' => [
            'key' => env('RAVE_PUBLIC_KEY'),
            'secret' => env('RAVE_SECRET_KEY'),
    ],
    'comments' => [
        'max'   => env('MAX_LEVEL_COMMENTS'),
    ],
    'replies' => [
        'max'   => env('MAX_REPLIES_TO_COMMENT'),
    ]
];
