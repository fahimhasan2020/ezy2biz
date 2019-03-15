<?php

namespace App\Http\Controllers;

use App\Core\LoginValidator;
use App\Model\Admin;
use App\Model\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request, LoginValidator $validator, Admin $admin)
    {
        $validator->validate($request);
        $adminObj = $admin->verify($request);
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

    public function getRequests(Admin $admin)
    {
        $pointRequests = $admin->getRequests()->all();
        return view('admin.point-requests')->with('requests', $pointRequests);
    }

    public function responseRequest(Request $request, Admin $admin, User $user)
    {
        $response = $request->get('response');
        if ('reject' === strtolower($response)) {
            $admin->rejectRequest($request);
        } elseif ('accept'  === strtolower($response)) {
            $admin->acceptRequest($request, $user);
        }

        return redirect('/a/requests');
    }
}
