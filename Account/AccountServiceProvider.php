<?php

namespace Bitaac\Account;

use Bitaac\Core\Providers\AggregateServiceProvider;

class AccountServiceProvider extends AggregateServiceProvider
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
            \Bitaac\Account\Resources\Seeds\DatabaseSeeder::class
        );

        parent::register();
    }
}
