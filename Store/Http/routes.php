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
$namespace = 'Bitaac\Store\Http\Controllers';

/*
|--------------------------------------------------------------------------
| /store routes
|--------------------------------------------------------------------------
|
| ...
|
*/
$router->group(['prefix' => '/store', 'middleware' => ['web'], 'namespace' => $namespace], function ($router) {
    $router->get('/', 'StoreController@index')->middleware(['web']);
    $router->get('/offers', 'Offer\OfferController@index');

    $router->get('/offers/paypal', 'Offer\Paypal\PaypalController@index');
    $router->post('/offers/paypal', 'Offer\Paypal\PaypalController@post');
    $router->get('/offers/paypal/return', [
        'as'   => 'paypal.return',
        'uses' => 'Offer\Paypal\PaypalController@return',
    ]);
    $router->get('/offers/paypal/cancel', [
        'as'   => 'paypal.cancel',
        'uses' => 'Offer\Paypal\PaypalController@cancel',
    ]);
});
