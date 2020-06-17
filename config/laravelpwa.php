<?php

return [
    'name' => 'BraveBat',
    'manifest' => [
        'name' => env('APP_NAME', 'BraveBat'),
        'short_name' => 'BraveBat',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation' => 'any',
        'icons' => [
            '72x72' => [
                'path' => '/images/logos/apple-icon-120.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/images/logos/apple-icon-120.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/images/logos/apple-icon-152.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/images/logos/apple-icon-152.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/images/logos/apple-icon-152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/logos/apple-icon-192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/images/logos/apple-icon-512.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/images/logos/apple-icon-512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/images/logos/apple-splash-640-1136.png',
            '750x1334' => '/images/logos/apple-splash-750-1334.png',
            '828x1792' => '/images/logos/apple-splash-828-1792.png',
            '1125x2436' => '/images/logos/apple-splash-1125-2436.png',
            '1242x2208' => '/images/logos/apple-splash-1242-2208.png',
            '1242x2688' => '/images/logos/apple-splash-1242-2688.png',
            '1536x2048' => '/images/logos/apple-splash-1536-2048.png',
            '1668x2224' => '/images/logos/apple-splash-1668-2224.png',
            '1668x2388' => '/images/logos/apple-splash-1668-2388.png',
            '2048x2732' => '/images/logos/apple-splash-2048-2732.png',
        ],
        'custom' => []
    ]
];
