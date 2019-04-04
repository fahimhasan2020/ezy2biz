<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

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
            $admin = DB::table('admins')
                ->where('id', '=', $request->session()->get('admin'))
                ->count();

            if ($admin) {
                return redirect('/a/dashboard');
            }

            $request->session()->flush();
        }

        return $next($request);
    }
}
