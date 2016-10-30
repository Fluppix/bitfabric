<?php

namespace Bitaac\Forum\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Bitaac\Forum\Models\Board;

class ForumController extends Controller
{
    /**
     * Show the forum boards to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bitaac::forum.index', [
            'boards' => (new Board)->all()
        ]);
    }
}
