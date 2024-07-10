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
    'stripe' => [
        'model' => App\User::class,
        'key' => "pk_test_51IYj28GrY4MmNjqDBDm475uJnGTawWmTX0KwVGrTCI4YRpu6yszT5RHylechYVTDamnKGoEzsbxigWdBYLmgzRwX00d0rnJRuf",
        'secret' => "sk_test_51IYj28GrY4MmNjqD3BW8xFpnayNlAJNI6NfvMVL3MRpm92NHGHHUo9Zduk0QXLq2hgoikeu8jrcJenoxVt8ECCqn00relyMihW",
        'webhook' => [
            'secret' => "whsec_l2HrB47roOvQk3oJAv9E88HTLWh8RnQy",
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

];
