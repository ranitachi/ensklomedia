<?php

namespace App\Http\Middleware;

use Closure;

class IsReviewer
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
        $reviewer = 3;

        if (Auth::check() && Auth::user()->authorization_level == $reviewer) {
            return $next($request);
        }

        return redirect()->guest('/');
    }
}
