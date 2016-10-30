<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application SSL
    |--------------------------------------------------------------------------
    |
    | Here you may specify whether the application should force a SSL (HTTPS)
    | mode across all pages and local URLs.
    |
    */
    
    'https' => env('APP_HTTPS', false),

    /*
    |--------------------------------------------------------------------------
    | Distro service provider
    |--------------------------------------------------------------------------
    | Currently available:
    |     bitaac\Othire\OthireServiceProvider::class
    |     Bitaac\Tfs10\Tfs10ServiceProvider::class
    |
    */

    'distro' => env('DISTRO', bitaac\Othire\OthireServiceProvider::class),

    /*
    |--------------------------------------------------------------------------
    | Theme service provider
    |--------------------------------------------------------------------------
    | Currently available:
    |     Bitaac\Theme\RetroThemeServiceProvider::class
    |
    */

    'theme' => Bitaac\Theme\RetroThemeServiceProvider::class,
    
];
