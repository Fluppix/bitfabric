<?php

namespace Bitaac\Store\Http\Controllers;

use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    /**
     * Show the store to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = app('store.products')->all();

        return view('bitaac::store.index')->with(compact('products'));
    }
}