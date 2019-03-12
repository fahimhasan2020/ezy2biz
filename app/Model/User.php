<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\ParameterBag;

class User extends Model
{
    public function exists(ParameterBag $userData)
    {
        return
            DB::table('users')
                ->select('id')
                ->where('email', '=', $userData->get('email'))
                ->count();
    }

    public function register(ParameterBag $userData)
    {
        return
            DB::table('users')
                ->insert([
                    'first_name'    => $userData->get('first-name'),
                    'last_name'     => $userData->get('last-name'),
                    'phone'         => $userData->get('phone'),
                    'address'       => $userData->get('address'),
                    'email'         => $userData->get('email'),
                    'password'      => $userData->get('password'),
                    'parent_id'     => $userData->get('parent-id'),
                    'referrer_id'   => $userData->get('referrer-id')
                ]);
    }

    public function verify(ParameterBag $credentials)
    {
        return
            DB::table('users')
                ->select('id')
                ->where([
                    ['email', '=', $credentials->get('email')],
                    ['password', '=', $credentials->get('password')]
                ])->first();
    }
}
