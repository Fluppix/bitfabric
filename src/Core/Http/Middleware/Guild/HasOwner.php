<?php

namespace Bitaac\Core\Http\Middleware\Guild;

use Closure;
use Illuminate\Support\Facades\Auth;

class HasOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $guild = $request->route()->parameters()['guild'];
        $account = auth()->user();

        if (is_null($guild)) {
            return redirect('/');
        }

        if (! $account->hasOwner($guild)) {
            return redirect('/');
        }

        return $next($request);
    }
}
