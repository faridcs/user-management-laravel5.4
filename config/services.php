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
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '1640282886278195',
        'client_secret' => 'da5d9f5b6512bf597a890d546bc92fd4',
        'redirect' => 'http://localhost/kree/public/callback/facebook',
    ],

    'google' => [
        'client_id' => '995923429832-rsfschfspv8k62o5c8lt29v5h7bsbcgb.apps.googleusercontent.com',
        'client_secret' => '6a5IEUhvnR9SbZ6P4N6bDz36',
        'redirect' => 'http://localhost/kree/public/callback/google',
    ],

    'twitter' => [
        'client_id' => 'w0zrbiyXTugyUeORsSbRLkpoH',
        'client_secret' => '956aBYYQ0byAFv7PXTdY3ETSKyad6EmSJ9I1WLvcpp6tiUOIeH',
        'redirect' => 'http://localhost/kree/public/callback/twitter',
    ],

];
