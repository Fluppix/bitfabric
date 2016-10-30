<?php

namespace Bitaac\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OwnsMoreCharactersThanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  integer  $amount
     * @return mixed
     */
    public function handle($request, Closure $next, $)
    {
        if (auth()->check() && auth()->user()->characters < $amount) {
            // 
        }

        return $next($request);
    }
}
