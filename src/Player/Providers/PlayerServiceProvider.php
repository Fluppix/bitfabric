<?php

namespace Bitaac\Player\Providers;

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
        require_once __DIR__.'/../Http/routes.php';

        $this->publishes([
            __DIR__.'/../Resources/Config' => config_path('bitaac'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['migration.handler']
            ->migrate(__DIR__.'/../Resources/Migrations')
            ->using('Bitaac\Player\Resources\Migrations')
            ->register();

        $this->app['seed.handler']->register(
            \Bitaac\Player\Resources\Seeds\DatabaseSeeder::class
        );

        parent::register();
    }
}
