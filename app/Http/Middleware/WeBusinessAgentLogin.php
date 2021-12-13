<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WeBusinessAgentLogin
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
        if ((Auth::user()->user_type == 2 || Auth::user()->user_type == 3) && Auth::user()->special_permission == 1) {
            return $next($request);
        }
        return response()->json('Invalid request', 400);
    }
}
