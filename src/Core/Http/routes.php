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

/*
|--------------------------------------------------------------------------
| Generic routes
|--------------------------------------------------------------------------
|
| ...
|
*/
$router->get('/', 'WelcomeController@index')->middleware('web');
