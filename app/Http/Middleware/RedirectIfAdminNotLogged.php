<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class RedirectIfAdminNotLogged
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
        if (!$request->session()->has('admin')) {
            return redirect('/a/login');
        }

        $admin = DB::table('admins')
            ->where('id', '=', $request->session()->get('admin'))
            ->count();

        if (!$admin) {
            $request->session()->flush();
            return redirect('/a/login');
        }

        return $next($request);
    }
}
