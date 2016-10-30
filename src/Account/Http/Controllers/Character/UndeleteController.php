<?php

namespace Bitaac\Core\Http\Controllers\Account\Character;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Bitaac\Player\BitPlayer;
use Bitaac\Http\Requests\Character\DeleteRequest;

class UndeleteController extends Controller
{
    /**
     * Show the undelete character form to the user
     *
     * @return \Illuminate\Http\Response
     */
    public function form($player)
    {
        if (! $player->hasPendingDeletion()) {
            return redirect('/account');
        }

        return view('bitaac::account.character.undelete')->with(compact('player'));
    }

    /**
     * Process the character undelete
     *
     * @return \Illuminate\Http\Response
     */
    public function post($player)
    {
        $player->bit->deletion_time = 0;
        $player->bit->save();

        return redirect('/account')->withSuccess("Character {$player->name} has been undeleted.");
    }
}
