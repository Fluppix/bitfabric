<?php

namespace Bitaac\Store\Providers;

use Illuminate\Routing\Router;
use Bitaac\Core\Providers\AggregateServiceProvider;

class StoreServiceProvider extends AggregateServiceProvider
{
    /**
     * Holds all service providers we want to register
     *
     * @var array
     */
    protected $providers = [
        //
    ];

    /**
     * Holds all contracts and models we want to bind
     *
     * @var array
     */
    protected $bindings = [
        'store.products' => [\Bitaac\Contracts\StoreProduct::class => \Bitaac\Store\Models\StoreProduct::class],
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
            __DIR__.'/../Config' => config_path('bitaac')
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
            ->using('Bitaac\Store\Resources\Migrations')
            ->register();

        parent::register();
    }
}
