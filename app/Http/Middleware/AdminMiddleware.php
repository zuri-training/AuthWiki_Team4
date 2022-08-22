<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth
};

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->admin || Auth::id() == 1) {
            return $next($request);
        }
        abort(403);
    }
}
