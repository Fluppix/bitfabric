<?php

namespace Bitaac\Community\Http\Controllers;

use App\Http\Controllers\Controller;

class DeathsController extends Controller
{
    /**
     * Show the deaths page to the user
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deaths = app('death')->limit(5)->get();

        return view('bitaac::community.deaths')->with(compact('deaths'));
    }
}
