<?php

namespace Bitaac\Highscore\Providers;

use Bitaac\Core\Providers\AggregateServiceProvider;

class HighscoreServiceProvider extends AggregateServiceProvider
{
    /**
     * Holds all service providers we want to register.
     *
     * @var array
     */
    protected $providers = [
        //
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        require_once __DIR__.'/../Http/routes.php';

        $this->publishes([
            __DIR__.'/../Config' => config_path('bitaac'),
        ], 'config');
    }
}
