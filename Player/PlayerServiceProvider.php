<?php

namespace Bitaac\Player;

use Bitaac\Core\Providers\AggregateServiceProvider;

class PlayerServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Player\Http\Controllers' => __DIR__.'/Http/routes.php',
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
        'character.exists' => \Bitaac\Player\Http\Middleware\CharacterExistsMiddleware::class,
        'owns.character'   => \Bitaac\Player\Http\Middleware\OwnsCharacterMiddleware::class,
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
            \Bitaac\Player\Resources\Seeds\DatabaseSeeder::class
        );

        parent::register();
    }
}
