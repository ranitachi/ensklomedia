<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        $admin = 1;

        if (Auth::check() && Auth::user()->authorization_level == $admin) {
            return $next($request);
        }

        return redirect()->guest('/');
    }
}
