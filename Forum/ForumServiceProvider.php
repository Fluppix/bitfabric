<?php

namespace Bitaac\Forum;

use Bitaac\Core\Providers\AggregateServiceProvider;

class ForumServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Forum\Http\Controllers' => __DIR__.'/Http/routes.php',
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
     * Holds all contracts and models we want to bind.
     *
     * @var array
     */
    protected $bindings = [
        'post' => [\Bitaac\Forum\Contracts\Post::class => \Bitaac\Forum\Models\Post::class],
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['seed.handler']->register(
            \Bitaac\Forum\Resources\Seeds\DatabaseSeeder::class
        );

        parent::register();
    }
}
