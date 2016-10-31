<?php

namespace Bitaac\Community;

use Bitaac\Core\Providers\AggregateServiceProvider;

class CommunityServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Community\Http\Controllers' => __DIR__.'/Http/routes.php',
    ];
}
