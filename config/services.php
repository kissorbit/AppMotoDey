<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),         // Your GitHub Client ID
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'), // Your GitHub Client Secret
        'redirect' => env('FACEBOOK_CLIENT_REDIRECT_URL','https://pappgen.com/login/facebook/callback'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),         // Your Google Client ID
        'client_secret' => env('GOOGLE_CLIENT_SECRET'), // Your Google Client Secret
        'redirect' => env('GOOGLE_CLIENT_REDIRECT_URL','http://pappgen.com/login/google/callback'),
    ],
    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID'),         // Your Google Client ID
        'client_secret' => env('TWITTER_CLIENT_SECRET'), // Your Google Client Secret
        'redirect' => env('TWITTER_CLIENT_REDIRECT_URL','http://pappgen.com/login/twitter/callback'),
    ],

];
