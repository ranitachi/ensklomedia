<?php

namespace App\Http\Middleware;

use Closure;

class IsSuperUser
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
        $superuser = 2;

        if (Auth::check() && Auth::user()->authorization_level == $superuser) {
            return $next($request);
        }

        return redirect()->guest('/');
    }
}
