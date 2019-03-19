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

    public function getPointRequests(Admin $admin)
    {
        $pointRequests = $admin->getPointRequests()->all();
        return view('admin.point-requests')->with('requests', $pointRequests);
    }

    public function responsePointRequest(Request $request, Admin $admin, User $user)
    {
        $response = $request->get('response');
        if ('reject' === strtolower($response)) {
            $admin->rejectPointRequest($request);
        } elseif ('accept'  === strtolower($response)) {
            $admin->acceptPointRequest($request, $user);
        }

        return redirect('/a/point-requests');
    }

    public function getWithdrawRequests(Admin $admin)
    {
        $pointRequests = $admin->getWithdrawRequests()->all();
        return view('admin.withdraw-requests')->with('requests', $pointRequests);
    }

    public function responseWithdrawRequest(Request $request, Admin $admin, User $user)
    {
        $response = $request->get('response');
        if ('reject' === strtolower($response)) {
            $admin->rejectWithdrawRequest($request);
        } elseif ('accept'  === strtolower($response)) {
            if ($user->checkPointsAvailable($request->get('applicant-id'), $request->get('points'))) {
                $admin->acceptWithdrawRequest($request, $user);
            }
            return redirect('a/withdraw-requests');
        }

        return redirect('/a/withdraw-requests');
    }

    public function getProductOrders(Admin $admin)
    {
        $orders = $admin->getOrders()->all();
        return view('admin.product-orders')->with('orders', $orders);
    }

    public function responseProductOrders(Request $request, Admin $admin)
    {
        $admin->responseOrder($request->get('order-id'), $request->get('response'));
        return redirect('/a/product-orders');
    }
}
