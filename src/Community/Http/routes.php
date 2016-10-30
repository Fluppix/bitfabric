<?php

/*
|--------------------------------------------------------------------------
| Assign the router & namespace to a variable
|--------------------------------------------------------------------------
|
| ...
|
*/
$router = app('router');
$namespace = 'Bitaac\Community\Http\Controllers';

/*
|--------------------------------------------------------------------------
| /online routes
|--------------------------------------------------------------------------
|
| ...
|
*/
$router->group(['middleware' => ['web'], 'namespace' => $namespace], function ($router) {
    $router->get('/online', 'OnlineController@index');
    $router->get('/deaths', 'DeathsController@index');
});
