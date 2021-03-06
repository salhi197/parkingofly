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
        'client_id' => '1024017105948-vujg1a98eun2o2lnvb6klm7p2ln6dje9.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],
    'facebook' => [
        'client_id' => '4652758041434599',
        'client_secret' => '229bb13c3e4cbee409f39942ab690894',
        'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],



];

