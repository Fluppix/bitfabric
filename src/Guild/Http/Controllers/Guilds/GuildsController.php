<?php

namespace Bitaac\Guild\Http\Controllers\Guilds;

use App\Http\Controllers\Controller;

class GuildsController extends Controller
{
    /**
     * Show the guilds to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guilds = app('guild')->all();

        return view('bitaac::guilds.index')->with(compact('guilds'));
    }
}
