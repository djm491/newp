<?php

namespace App\Http\Middleware;

use Closure;

class NewPAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $platform = session()->get('platform');
        if ( $platform !== "newp" ) {
            return redirect()->intended('/login');
        }
        return $next($request);
    }
}
