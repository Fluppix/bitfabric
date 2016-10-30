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
$namespace = 'Bitaac\Guild\Http\Controllers';

/*
|--------------------------------------------------------------------------
| Invidual guild routes
|--------------------------------------------------------------------------
|
| ...
|
*/
$router->group(['prefix' => '/guild', 'namespace' => $namespace], function ($router) {
    $router->get('/{guild}', 'Guild\ShowController@show')->middleware(['web']);
    $router->get('/{guild}/invite', 'Guild\Member\InviteController@form')->middleware(['web', 'can.invite']);
    $router->post('/{guild}/invite', 'Guild\Member\InviteController@post')->middleware(['web', 'can.invite']);
    $router->get('/{guild}/join', 'Guild\Member\JoinController@form')->middleware(['web', 'auth', 'has.invite']);
    $router->post('/{guild}/join', 'Guild\Member\JoinController@post')->middleware(['web', 'auth', 'has.invite']);
    $router->get('/{guild}/cancel', 'Guild\Member\CancelController@form')->middleware(['web', 'auth', 'can.invite']);
    $router->post('/{guild}/cancel', 'Guild\Member\CancelController@post')->middleware(['web', 'auth', 'can.invite']);
    $router->get('/{guild}/disband', 'Guild\DisbandController@form')->middleware(['web', 'auth', 'has.owner']);
    $router->post('/{guild}/disband', 'Guild\DisbandController@post')->middleware(['web', 'auth', 'has.owner']);
    $router->get('/{guild}/edit', 'Guild\EditController@form')->middleware(['web', 'auth', 'can.edit']);
    $router->post('/{guild}/edit', 'Guild\EditController@post')->middleware(['web', 'auth', 'can.edit']);
    $router->get('/{guild}/leave', 'Guild\Member\LeaveController@form')->middleware(['web', 'auth']);
    $router->post('/{guild}/leave', 'Guild\Member\LeaveController@post')->middleware(['web', 'auth']);
    $router->get('/{guild}/ranks', 'Guild\RankController@form')->middleware(['web', 'auth', 'can.edit']);
    $router->post('/{guild}/ranks', 'Guild\RankController@post')->middleware(['web', 'auth', 'can.edit']);
    $router->get('/{guild}/members', 'Guild\Member\EditController@form')->middleware(['web', 'auth', 'can.edit']);
    $router->post('/{guild}/members', 'Guild\Member\EditController@post')->middleware(['web', 'auth', 'can.edit']);
    $router->get('/{guild}/edit/deletelogo', 'Guild\EditController@deletelogo')->middleware(['web', 'auth', 'can.edit']);
});

/*
|--------------------------------------------------------------------------
| Generic guilds routes
|--------------------------------------------------------------------------
|
| ...
|
*/
$router->group(['prefix' => '/guilds', 'namespace' => $namespace], function ($router) {
    $router->get('/', 'Guilds\GuildsController@index')->middleware(['web']);
    $router->get('/create', 'Guilds\CreateController@form')->middleware(['web', 'auth']);
    $router->post('/create', 'Guilds\CreateController@post')->middleware(['web', 'auth']);
    $router->get('/{guild}/logo', 'ShowController@logo')->middleware(['web']);
});
