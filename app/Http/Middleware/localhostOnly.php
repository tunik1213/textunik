<?php

namespace App\Http\Middleware;

use Closure;

class LocalhostOnly
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
        if (
	    $request->server('SERVER_ADDR') != $request->server('REMOTE_ADDR')
	 && $request->server('REMOTE_ADDR') != '127.0.0.1'
	) {
            abort(403);
        }

        return $next($request);
    }
}
