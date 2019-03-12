<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAdminLogged
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
        if ($request->session()->has('admin')) {
            return redirect('a/dashboard');
        }
        return $next($request);
    }
}
