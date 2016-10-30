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
$namespace = 'Bitaac\Highscore\Http\Controllers';

/*
|--------------------------------------------------------------------------
| /highscore routes
|--------------------------------------------------------------------------
|
| ...
|
*/
$router->group(['prefix' => '/highscore', 'namespace' => $namespace], function ($router) {
    $router->get('/{skill?}/{vocation?}', 'HighscoreController@index')->middleware(['web']);
    $router->post('/{skill?}/{vocation?}', 'HighscoreController@post')->middleware(['web']);
});
