<?php

/*
|--------------------------------------------------------------------------
| Assign the router & namespace to a variable
|--------------------------------------------------------------------------
|
| ...
|
*/
$router    = app('router');
$namespace = 'Bitaac\Player\Http\Controllers';

/*
|--------------------------------------------------------------------------
| /character routes
|--------------------------------------------------------------------------
|
| ...
|
*/
$router->group(['prefix' => '/character', 'middleware' => ['web'], 'namespace' => $namespace], function($router){
    $router->get('/',          'SearchController@form');
    $router->post('/',         'SearchController@post');
    $router->get('/{player}',  'CharacterController@index')->middleware('character.exists');
});

// Experimental right now, not sure how we want to include
// such libraries yet..
$router->get('/character/{player}/outfit', function($player){
    $outfit = new Bitaac\Libraries\Outfit\Outfit();

    $outfit->looktype = $player->looktype;

    return response($outfit->render())->header('Content-type', 'image/png');
});
