<?php

namespace App\Http\Controllers;

use App\Core\LoginValidator;
use App\Model\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request, LoginValidator $validator, Admin $admin)
    {
        $validator->validate($request->request);
        $adminObj = $admin->verify($request->request);
        if (isset($adminObj) && $adminObj->id) {
            $request->session()->put('admin', $adminObj->id);
            return redirect('/a/dashboard');
        }

        //Show unsuccessful login
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return view('admin.logout');
    }
}
