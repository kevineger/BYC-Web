<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotVendor
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
        if (!$request->user()->vendor && !$request->user()->admin) {
            return redirect()->back();
        }
        return $next($request);
    }
}
