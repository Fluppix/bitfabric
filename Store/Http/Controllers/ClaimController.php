<?php

namespace Bitaac\Store\Http\Controllers;

use Bitaac\Contracts\StoreProduct;
use App\Http\Controllers\Controller;

class ClaimController extends Controller
{
    /**
     * Show the product claim form to user.
     *
     * @param  \Bitaac\Store\Models\StoreProduct  $product
     * @return \Illuminate\Http\Response
     */
    public function form(StoreProduct $product)
    {
        return view('bitaac::store.claim')->with(compact('product'));
    }
}
