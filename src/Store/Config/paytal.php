<?php

return [

    /*
    |--------------------------------------------------------------------------
    | paytal/paypal settings
    |--------------------------------------------------------------------------
    |
    |
    */

    'paypal' => [
        'enabled'  => true,
        'currency' => 'USD',

        'auth' => [
            'client' => env('PAYPAL_CLIENT', 'XXX'),
            'secret' => env('PAYPAL_SECRET', 'XXX'),
            'returnUrl' => 'paypal.return',
            'cancelUrl' => 'paypal.cancel'
        ],

        'offers' => [
            '10.00' => 250,
            '15.00' => 350, 
            '20.00' => 450
        ]
    ],

];