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
            $request->session()->regenerateToken();
            $request->session()->put('admin', $adminObj->id);
            return redirect('/a/dashboard');
        }

        //Show unsuccessful login
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/a/login');
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

    public function showAllUsers(User $user)
    {
        $query = $user->getAll()->all();
        return view('admin.all-users')->with('users', $query);
    }

    public function getUserEditForm($userId, User $user)
    {
        $query = $user->getUser($userId);
        return view('admin.edit-user')->with('user', $query);
    }

    public function editUser($userId, Request $request, User $user)
    {
        $user->adminEdit($userId, $request);
        return redirect('/a/users');
    }

    public function deleteUser(Request $request, User $user)
    {
        $userId = $request->get('user-id');
        $user->remove($userId);
        return redirect('/a/users');
    }

    public function getUser($userId, User $user)
    {
        $query = $user->getUserFull($userId);
        return view('admin.single-user')->with('user', $query);
    }
}
