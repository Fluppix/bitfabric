<?php

namespace Bitaac\Core\Providers;

use Illuminate\Routing\Router;
use Bitaac\Forum\Models\Board;
use Bitaac\Forum\Models\ForumPost;
use App\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Bitaac\Core\Http\Controllers';

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // TO:DO
        'has.leader'       => \Bitaac\Core\Http\Middleware\Guild\HasLeader::class,
        'has.vice.leader'  => \Bitaac\Core\Http\Middleware\Guild\HasViceLeader::class,
        'has.member'       => \Bitaac\Core\Http\Middleware\Guild\HasMember::class,

        // forum
        'not.locked'       => \Bitaac\Core\Http\Middleware\Forum\NotLocked::class,
    ];

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Bitaac\Core\Http\Middleware\DeleteCharacterMiddleware::class,
    ];

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot()
    {
        $this->app['router']->bind('player', function ($name) {
            $name = str_replace('-', ' ', $name);

            return app('player')->where('name', $name)->first();
        });

        $this->app['router']->bind('thread', function ($thread) {
            return (new ForumPost)->where('title', str_replace('-', ' ', $thread))->first();
        });

        $this->app['router']->bind('guild', function ($guild) {
            return app('guild')->where('name', str_replace('-', ' ', $guild))->first();
        });

        $this->app['router']->bind('board', function ($board) {
            return (new Board)->where('title', str_replace('-', ' ', $board))->first();
        });

        $kernel = app('\Illuminate\Contracts\Http\Kernel');

        array_walk($this->routeMiddleware, function ($class, $name) {
            $this->app['router']->middleware($name, $class);
        });

        array_walk($this->middleware, function ($class) use ($kernel) {
            $kernel->prependMiddleware($class);
            $kernel->pushMiddleware($class);
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        parent::map();

        // ..
    }
}
