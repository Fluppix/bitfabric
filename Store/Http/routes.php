<?php

/*
|--------------------------------------------------------------------------
| /store routes
|--------------------------------------------------------------------------
|
| ...
|
*/

$router->group(['prefix' => '/store'], function ($router) {
    $router->get('/', 'StoreController@index');
    $router->get('/offers', 'Offer\OfferController@index');
    $router->get('/offers/{gateway}', 'Offer\PaymentController@index');
    $router->post('/offers/{gateway}', 'Offer\PaymentController@post');
    $router->get('/offers/{gateway}/return', 'Offer\PaymentController@return')->name('gateway.return');
    $router->get('/offers/{gateway}/cancel', 'Offer\PaymentController@cancel')->name('gateway.cancel');
});
