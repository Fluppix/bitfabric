<?php

namespace Bitaac\Player;

use Bitaac\Core\Providers\AggregateServiceProvider;

class PlayerServiceProvider extends AggregateServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        require_once __DIR__.'/Http/routes.php';

        $this->publishes([
            __DIR__.'/Resources/Config' => config_path('bitaac'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/Resources/Migrations');

        $this->app['seed.handler']->register(
            \Bitaac\Player\Resources\Seeds\DatabaseSeeder::class
        );

        parent::register();
    }
}
