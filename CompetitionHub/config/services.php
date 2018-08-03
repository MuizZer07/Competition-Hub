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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' =>'699635529846-fs3q4o57om079v2o71s7qb8aueohrn51.apps.googleusercontent.com',  // Your Google Client ID
        'client_secret' =>'hS0LnX65woIfTj-3fJ8_Gh3C', // Your Google Client Secret
        'redirect' => 'http://ch.me/login/google/callback',
    ],

    'linkedin' => [
        'client_id' =>'81xffwl50trg1t',  // Your Google Client ID
        'client_secret' =>'bq0qgSALEUkK0A3N', // Your Google Client Secret
        'redirect' => 'http://ch.me/login/linkedin/callback',

    ],

];
