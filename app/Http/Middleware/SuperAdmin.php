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
        $u = Auth::user();
        if (($u === null) || ($u->id != 1)) {
            //return view('staticPages.forbidden');
            abort(403, 'Доступ запрещен');
        }

        return $next($request);
    }
}
