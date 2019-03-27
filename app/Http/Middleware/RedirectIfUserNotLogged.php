<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class RedirectIfUserNotLogged
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
        if (!$request->session()->has('user')) {
            return redirect('/register');
        }

        $user = DB::table('users')
            ->where('id', '=', $request->session()->get('user'))
            ->count();

        if (!$user) {
            $request->session()->flush();
            return redirect('u/dashboard');
        }

        return $next($request);
    }
}
