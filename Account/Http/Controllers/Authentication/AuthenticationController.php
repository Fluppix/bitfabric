<?php

namespace Bitaac\Account\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

class AuthenticationController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Show the authentication page to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('bitaac::account.authentication.index');
    }

    /**
     * Update the two-factor authentication.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $user = auth()->user();
        $secret = $request->get('secret');
        $valid = \Google2FA::verifyKey($user->bit->secret, $secret);

        if (! $valid) {
            return back()->withError(trans('authentication.not.valid'));
        }

        if ($user->secret) {
            $user->secret = '';
            $user->save();

            return back()->withSuccess(trans('authentication.disable.success'));
        } else {
            $user->secret = $user->bit->secret;
            $user->save();

            return back()->withSuccess(trans('authentication.enable.success'));
        }
    }
}
