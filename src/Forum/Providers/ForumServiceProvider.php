<?php

namespace Bitaac\Forum\Providers;

use Illuminate\Routing\Router;
use Bitaac\Core\Providers\AggregateServiceProvider;

class ForumServiceProvider extends AggregateServiceProvider
{
    /**
     * Holds all contracts and models we want to bind
     *
     * @var array
     */
    protected $bindings = [
        'post' => [\Bitaac\Forum\Contracts\Post::class => \Bitaac\Forum\Models\Post::class],
    ];

    /**
     * Holds all service providers we want to register
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
            ->using('Bitaac\Forum\Resources\Migrations')
            ->register();

        $this->app['seed.handler']->register(
            \Bitaac\Forum\Resources\Seeds\DatabaseSeeder::class
        );

        parent::register();
    }
}
