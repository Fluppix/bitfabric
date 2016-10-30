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
$namespace = 'Bitaac\Forum\Http\Controllers';

/*
|--------------------------------------------------------------------------
| /forum routes
|--------------------------------------------------------------------------
|
|
|
*/
$router->group(['prefix' => '/forum', 'middleware' => ['web'], 'namespace' => $namespace], function($router){
    $router->get('/',                         'ForumController@index');
    $router->get('/{board}/create',           'Thread\CreateController@form')->middleware('auth');
    $router->post('/{board}/create',          'Thread\CreateController@post')->middleware('auth');
    $router->get('/{board}',                  'Board\ShowController@index');
    $router->get('/{board}/{thread}',         'Thread\ShowController@index');
    $router->get('/{board}/{thread}/reply',   'Thread\ReplyController@index')->middleware(['auth', 'not.locked']);
    $router->post('/{board}/{thread}/reply',  'Thread\ReplyController@post')->middleware(['auth', 'not.locked']);
    $router->get('/{board}/{thread}/lock',    'Thread\LockController@form')->middleware(['auth', 'admin']);
    $router->post('/{board}/{thread}/lock',   'Thread\LockController@post')->middleware(['auth', 'admin']);
    $router->get('/{board}/{thread}/unlock',  'Thread\UnlockController@form')->middleware(['auth', 'admin']);
    $router->post('/{board}/{thread}/unlock', 'Thread\UnlockController@post')->middleware(['auth', 'admin']);
    $router->get('/{board}/{thread}/delete',  'Thread\DeleteController@form')->middleware(['auth', 'admin']);
    $router->post('/{board}/{thread}/delete', 'Thread\DeleteController@post')->middleware(['auth', 'admin']);
});
