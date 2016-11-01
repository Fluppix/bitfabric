<?php

/*
|--------------------------------------------------------------------------
| /admin Routes
|--------------------------------------------------------------------------
|
| ...
|
*/

$router->group(['prefix' => '/admin', 'middleware' => ['auth', 'admin']], function ($router) {
    $router->get('/', 'AdminController');
    $router->get('/store/products', 'Store\ProductsController@index');
    $router->get('/store/products/create', 'Store\ProductsController@form');
    $router->post('/store/products/create', 'Store\ProductsController@post');
});
