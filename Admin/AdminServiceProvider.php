<?php

namespace Bitaac\Admin;

use Bitaac\Core\Providers\AggregateServiceProvider;

class AdminServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Admin\Http\Controllers' => __DIR__.'/Http/routes.php',
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // $this->publishes([
        //     __DIR__.'/Config' => config_path('bitaac'),
        // ], 'config');
    }
}
