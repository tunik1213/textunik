<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
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
        if (!env('APP_DEBUG')) {
            $u = Auth::user();
            if (($u === null) || (!$u->superAdmin())) {
                abort(403);
            }
        }

        return $next($request);
    }
}
