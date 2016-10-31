<?php

namespace Bitaac\Admin\Http\Controllers;

use Bitaac\Contracts\Player;
use Bitaac\Contracts\Account;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Show application adminpanel index to user.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Account $account, Player $player)
    {
        $player = $player->get();

        return view('admin::index')->with([
            'totalAccounts' => $account->count(),
            'totalPlayers'  => $player->count(),
            'highestLevel'  => $player->sortByDesc('level')->first()->level,
            'averageLevel'  => number_format($player->pluck('level')->avg()),
        ]);
    }
}
