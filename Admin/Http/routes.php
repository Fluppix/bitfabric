<?php

/*
|--------------------------------------------------------------------------
| /admin Routes
|--------------------------------------------------------------------------
|
| ...
|
*/

$router->group(['prefix' => '/admin'], function ($router) {
    $router->get('/', 'AdminController')->middleware(['auth', 'admin']);
});
