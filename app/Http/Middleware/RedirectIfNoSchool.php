<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNoSchool
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
        if ($request->user()->school == null) {
            return redirect()->back();
        }
        return $next($request);
    }
}