<?php

namespace Bitaac\Guild\Providers;

use Bitaac\Core\Providers\AggregateServiceProvider;

class GuildServiceProvider extends AggregateServiceProvider
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
            ->using('Bitaac\Guild\Resources\Migrations')
            ->register();

        $this->app['seed.handler']->register(
            \Bitaac\Guild\Resources\Seeds\DatabaseSeeder::class
        );

        parent::register();
    }
}
