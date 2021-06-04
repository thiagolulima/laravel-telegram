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
    'telegram-bot-api' => [
        'token' => env('TELEGRAM_BOT_API','1824928776:AAEA4Iq-5q_vOm7jXwcPH9aW_Dk_p7SbHYA')
    ],
    'telegram_id' => env('TELEGRAM_ID','1037258204'),
    'telegram_getUpdates' => 'https://api.telegram.org/bot1824928776:AAEA4Iq-5q_vOm7jXwcPH9aW_Dk_p7SbHYA/getUpdates',
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

];
