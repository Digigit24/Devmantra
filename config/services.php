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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'openai' => [
        'key'   => env('OPENAI_API_KEY'),
        'base'  => env('OPENAI_API_BASE', 'https://api.openai.com/v1'),
        'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
    ],

    'kimi' => [
        'key'   => env('KIMI_API_KEY'),
        'base'  => env('KIMI_API_BASE', 'https://api.moonshot.ai/v1'),
        'model' => env('KIMI_MODEL', 'kimi-latest'),
    ],

    'grok' => [
        'key'   => env('GROK_API_KEY'),
        // NOTE: your current GROK_API_KEY (gsk_...) is a Groq Cloud key, not an
        // xAI key — it will fail against api.x.ai. Either set GROK_API_BASE to
        // https://api.groq.com/openai/v1 to use it as-is, or replace the key
        // with a real xAI key from console.x.ai to keep this endpoint.
        'base'  => env('GROK_API_BASE', 'https://api.x.ai/v1'),
        'model' => env('GROK_MODEL', 'grok-3-mini'),
    ],

    'meta' => [
        // Meta (Facebook) Pixel ID used on the /vision-card landing page.
        'pixel_id' => env('META_PIXEL_ID', '1298473208904876'),
        // Conversions API (server-side) access token, generated in
        // Events Manager > Settings > Conversions API for this pixel.
        // Leave blank to disable server-side event sending — the browser
        // pixel will keep working on its own.
        'capi_token' => env('META_CAPI_ACCESS_TOKEN'),
        // Optional: pin a specific Graph API version.
        'capi_version' => env('META_CAPI_VERSION', 'v19.0'),
    ],

];
