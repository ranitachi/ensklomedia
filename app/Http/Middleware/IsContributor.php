<?php

namespace App\Http\Middleware;

use Closure;

class IsContributor
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
        $contributor = 4;

        if (Auth::check() && Auth::user()->authorization_level == $contributor) {
            return $next($request);
        }

        return redirect()->guest('/');
    }
}
