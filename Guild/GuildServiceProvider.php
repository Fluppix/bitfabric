<?php

namespace Bitaac\Guild;

use Bitaac\Core\Providers\AggregateServiceProvider;

class GuildServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Guild\Http\Controllers' => __DIR__.'/Http/routes.php',
    ];

    /**
     * The provider migration paths.
     *
     * @var array
     */
    protected $migrations = [
        __DIR__.'/Resources/Migrations',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'can.edit'   => \Bitaac\Guild\Http\Middleware\CanEditMiddleware::class,
        'can.invite' => \Bitaac\Guild\Http\Middleware\CanInviteMiddleware::class,
        'has.owner'  => \Bitaac\Guild\Http\Middleware\HasOwnerMiddleware::class,
        'has.invite' => \Bitaac\Guild\Http\Middleware\HasInviteMiddleware::class,
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

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
        $this->app['seed.handler']->register(
            \Bitaac\Guild\Resources\Seeds\DatabaseSeeder::class
        );

        parent::register();
    }
}
