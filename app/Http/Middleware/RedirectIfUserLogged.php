<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class RedirectIfUserLogged
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
        if ($request->session()->has('user')) {
            $user = DB::table('users')
                ->where('id', '=', $request->session()->get('user'))
                ->count();

            if ($user) {
                return redirect('u/dashboard');
            }

            $request->session()->flush();
        }

        return $next($request);
    }
}
