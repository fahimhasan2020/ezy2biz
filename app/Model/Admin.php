<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\ParameterBag;

class Admin extends Model
{
    public function exists(ParameterBag $userData)
    {
        return
            DB::table('admins')
                ->select('id')
                ->where('email', '=', $userData->get('email'))
                ->count();
    }

    public function verify(ParameterBag $credentials)
    {
        return
            DB::table('admins')
                ->select('id')
                ->where([
                    ['email', '=', $credentials->get('email')],
                    ['password', '=', $credentials->get('password')]
                ])->first();
    }
}
