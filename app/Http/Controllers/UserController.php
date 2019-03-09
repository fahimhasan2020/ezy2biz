<?php

namespace App\Http\Controllers;

use App\Core\LoginValidator;
use App\Core\RegistrationValidator;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request, RegistrationValidator $validator, User $user)
    {
        $validator->validate($request->request);
        if (!$user->exists($request->request)) {
            $user->register($request->request);
        }
    }

    public function login(Request $request, LoginValidator $validator, User $user)
    {
        $validator->validate($request->request);
        $userObj = $user->verify($request->request);
        if ($userObj->id) {
            $request->session()->put('user', $userObj->id);
            return redirect('/u/dashboard');
        }

        //Show unsuccessful login
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return view('user.logout');
    }
}
