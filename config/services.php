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

    'vimeo' => [
        'client_id' => env('VIMEO_CLIENT_ID'),
        'client_secret' => env('VIMEO_CLIENT_SECRET'),
    ],

    'youtube' => [
        'api_key' => env('YOUTUBE_API_KEY'),
    ],

    'twitch' => [
        'client_id' => env('TWITCH_CLIENT_ID'),
        'client_secret' => env('TWITCH_CLIENT_SECRET'),
    ],

    'twitter' => [
        'client_id' => env('TWITTER_API_KEY'),
        'client_secret' => env('TWITTER_API_SECRET_KEY'),
        'access_token' => env('TWITTER_ACCESS_TOKEN'),
        'access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
    ],

    'github' => [
        'user' => env('GITHUB_USER'),
        'token' => env('GITHUB_TOKEN'),
    ],

    'slack' => [
        'webhook' => env('SLACK_WEBHOOK'),
    ],

    'recaptcha' => [
        'key' => env('RECAPTCHA_KEY'),
        'secret' => env('RECAPTCHA_SECRET'),
    ],

    'ethplorer' => [
        'bat_token_address' => env('BAT_TOKEN_ADDRESS'),
        'api_key' => env('ETHPLORER_API_KEY'),
    ],

    'telegram' => [
        'bot_token' => env('TELEGRAM_BOT_TOKEN'),
    ],

    'meili' => [
        'master_key' => env('MEILI_MASTER_KEY'),
        'public_key' => env('MEILI_PUBLIC_KEY'),
        'private_key' => env('MEILI_PRIVATE_KEY'),
    ],
];
