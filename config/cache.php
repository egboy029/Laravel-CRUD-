<?php

return [
    'default' => env('CACHE_DRIVER', 'file'),

    'stores' => [
        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],
        // ... other cache configurations
    ],

    'prefix' => env('CACHE_PREFIX', 'laravel_cache'),
];
