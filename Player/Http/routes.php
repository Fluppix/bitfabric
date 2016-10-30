<?php

/*
|--------------------------------------------------------------------------
| /character routes
|--------------------------------------------------------------------------
|
| ...
|
*/

$router->group(['prefix' => '/character'], function ($router) {
    $router->get('/', 'SearchController@form');
    $router->post('/', 'SearchController@post');
    $router->get('/{player}', 'CharacterController@index')->middleware('character.exists');
});
