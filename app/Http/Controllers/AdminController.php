<?php

namespace App\Http\Controllers;

use App\Core\ImageStore;
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
            $request->session()->flush();
            $request->session()->regenerateToken();
            $request->session()->put('admin-name', "{$adminObj->first_name} {$adminObj->last_name}");
            $request->session()->put('admin', $adminObj->id);

            $request->session()->flash('s', 'Login successful! Welcome');
            return redirect('/a/dashboard');
        }

        $request->session()->flash('e', 'Login failed! Email/password did not match');
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
            if ($admin->rejectPointRequest($request)) {
                $request->session()->flash('s', 'You have successfully rejected the request');
                return redirect('/a/point-requests');
            }
        } elseif ('accept'  === strtolower($response)) {
            $admin->acceptPointRequest($request, $user);
            $request->session()->flash('s', 'You have successfully accepted the request');
            return redirect('/a/point-requests');
        }

        $request->session()->flash('e', 'Your action was unsuccessful');
        return redirect('/a/point-requests');
    }

    public function getWithdrawRequests(Admin $admin)
    {
        $pointRequests = $admin->getWithdrawRequests()->all();
        return view('admin.withdraw-requests')->with('requests', $pointRequests);
    }

    public function getWithdrawHistory(Request $request, Admin $admin)
    {
        if (!$request->get('page') || !(int) $request->get('page')) {
            return redirect('/a/withdraw-requests/history?page=1');
        } else {
            $curPage = (int) $request->get('page');
        }

        $count = $admin->countWithdrawHistory();
        $perPage = 20;
        $totalPages = ceil($count / $perPage);
        $offset = $perPage * ($curPage - 1);

        if (1 <= $curPage - 1) {
            $prevPage = $curPage - 1;
        } else {
            $prevPage = null;
        }

        if ($curPage + 1 <= $totalPages) {
            $nexPage = $curPage + 1;
        } else {
            $nexPage = null;
        }

        $query = $admin->paginateWithdrawHistory($perPage, $offset)->all();

        return view('admin.withdraw-history')
            ->with('requests', $query)
            ->with('totalPages', $totalPages)
            ->with('curPage', $curPage)
            ->with('prevPage', $prevPage)
            ->with('nextPage', $nexPage);
    }

    public function responseWithdrawRequest(Request $request, Admin $admin, User $user)
    {
        $response = $request->get('response');
        if ('reject' === strtolower($response)) {
            if ($admin->rejectWithdrawRequest($request)) {
                $request->session()->flash('s', 'You have successfully rejected the request');
                return redirect('/a/withdraw-requests');
            }
        } elseif ('accept'  === strtolower($response)) {
            if ($user->checkPointsAvailable($request->get('applicant-id'), $request->get('points'))) {
                $admin->acceptWithdrawRequest($request, $user);
                $request->session()->flash('s', 'You have successfully accepted the request');
            } else {
                $request->session()->flash('e', 'User do not have sufficient points for this action');
            }
            return redirect('a/withdraw-requests');
        }

        $request->session()->flash('e', 'Your action was unsuccessful');
        return redirect('a/withdraw-requests');
    }

    public function getProductOrders(Admin $admin)
    {
        $orders = $admin->getOrders()->all();
        return view('admin.product-orders')->with('orders', $orders);
    }

    public function responseProductOrders(Request $request, Admin $admin)
    {
        if ($admin->responseOrder($request->get('order-id'), $request->get('response'))) {

            $request->session()->flash('s', 'Your action was successful');
        } else {
            $request->session()->flash('e', 'Your action was unsuccessful');
        }
        return redirect('/a/product-orders');
    }

    public function showAllUsers(Request $request, User $user)
    {
        if (!$request->get('page') || !(int) $request->get('page')) {
            return redirect('/a/users?page=1');
        } else {
            $curPage = (int) $request->get('page');
        }

        $count = $user->countTotal();
        $perPage = 20;
        $totalPages = ceil($count / $perPage);
        $offset = $perPage * ($curPage - 1);

        if (1 <= $curPage - 1) {
            $prevPage = $curPage - 1;
        } else {
            $prevPage = null;
        }

        if ($curPage + 1 <= $totalPages) {
            $nexPage = $curPage + 1;
        } else {
            $nexPage = null;
        }

        $query = $user->paginate($perPage, $offset)->all();

        return view('admin.all-users')
            ->with('users', $query)
            ->with('totalPages', $totalPages)
            ->with('curPage', $curPage)
            ->with('prevPage', $prevPage)
            ->with('nextPage', $nexPage);
    }

    public function getUserEditForm($userId, User $user)
    {
        $query = $user->getUser($userId);
        return view('admin.edit-user')->with('user', $query);
    }

    public function editUser($userId, Request $request, User $user)
    {
        if ($user->adminEdit($userId, $request)) {

            $request->session()->flash('s', 'User was successfully updated');
            return redirect('/a/users?page=1');
        }

        $request->session()->flash('e', 'Something went wrong! User could not be updated');
        return redirect()->back();
    }

    public function deleteUser(Request $request, User $user)
    {
        $userId = $request->get('user-id');
        if ($user->remove($userId)) {
            $request->session()->flash('s', 'User was deleted successfully');
            return redirect('/a/users?page=1');
        } else {
            $request->session()->flash('s', 'Sorry! User could not be deleted');
            return redirect('/a/users?page=1');
        }
    }

    public function getUser($userId, User $user)
    {
        $query = $user->getUserFull($userId);
        return view('admin.single-user')->with('user', $query);
    }

    public function getSettings(Request $request, Admin $admin)
    {
        $adminId = $request->session()->get('admin');
        $query = $admin->getAdmin($adminId);

        return view('admin.settings')->with('admin', $query);
    }

    public function editSettings(Request $request, Admin $admin)
    {
        $adminId = $request->session()->get('admin');
        if ($admin->verifyPassword($adminId, $request->get('password'))) {
            if ($admin->changeCredentials($adminId, $request)) {
                $request->session()->flush();
                $request->session()->flash('s', 'Your account settings were changed. Please login again');
                return redirect('/a/login');
            }

            $request->session()->flash('e', 'Something went wrong! Your account settings could not be updated');
        }

        $request->session()->flash('e', 'Your password did not match');
        return redirect()->back();
    }

    public function getAccount(Request $request, Admin $admin)
    {
        $adminId = $request->session()->get('admin');
        $query = $admin->getAdmin($adminId);
        $accounts = $admin->getBankingAccounts()->all();

        return view('admin.account')
            ->with('admin', $query)
            ->with('accounts', $accounts)
            ->with('action', strtolower($request->get('action')));
    }

    public function editProfile(Request $request, Admin $admin)
    {
        $adminId = $request->session()->get('admin');
        if ($admin->editAdmin($adminId, $request)) {

            $request->session()->flash('s', 'Your account was successfully updated');
            return redirect('/a/account');
        }

        $request->session()->flash('e', 'Your account could not be updated');
        return redirect()->back();
    }

    public function editBkash(Request $request, Admin $admin)
    {
        $adminId = $request->session()->get('admin');
        if ($admin->verifyPassword($adminId, $request->get('password'))) {
            if ($admin->editBkash($request)) {

                $request->session()->flash('s', 'New bKash account was added successfully');
                return redirect('/a/account');
            }

            $request->session()->flash('e', 'Something went wrong! New bKash account could not be added');
            return redirect()->back();
        }

        $request->session()->flash('e', 'Your password did not match');
        return redirect()->back();
    }

    public function editRocket(Request $request, Admin $admin)
    {
        $adminId = $request->session()->get('admin');
        if ($admin->verifyPassword($adminId, $request->get('password'))) {
            if ($admin->editRocket($request)) {

                $request->session()->flash('s', 'New Rocket account was successfully added');
                return redirect('/a/account');
            }

            $request->session()->flash('s', 'Something went wrong! New Rocket account could not be added');
            return redirect('/a/account');
        }

        $request->session()->flash('e', 'Your password did not match');
        return redirect()->back();
    }

    public function dashboard(Admin $admin, User $user)
    {
        $countPointRequests = $admin->countPointRequests();
        $countProductOrders = $admin->countProductOrders();
        $countWithdrawRequests = $admin->countWithdrawRequests();
        $countUsers = $user->countTotal();

        $getSlideImages = $admin->getSlideImages()->all();

        return view('admin.dashboard')
            ->with('totalPointRequests', $countPointRequests)
            ->with('totalProductOrders', $countProductOrders)
            ->with('totalWithdrawRequests', $countWithdrawRequests)
            ->with('totalUsers', $countUsers)
            ->with('images', $getSlideImages);
    }

    public function addSlideImages(Request $request, Admin $admin, ImageStore $store)
    {
        $request->request->add(['image-paths' => []]);
        if ($store->addSlideImages($request)) {
            if ($admin->addImages($request->get('image-paths'))) {
                $request->session()->flash('s', 'Congratulations! Images were successfully added to slide');
                return redirect('/a/dashboard');
            } else {
                $request->session()->flash('e', 'Sorry! Could not add images to slide');
                return redirect('/a/dashboard');
            }
        }

        $request->session()->flash('e', 'Oops! Something went wrong!');
        return redirect('/a/dashboard');
    }

    public function deleteSlideImage(Request $request, Admin $admin, ImageStore $store)
    {
        if ($admin->deleteImage($request->get('id'))) {
            $store->removeImage($request->get('image-path'));
            $request->session()->flash('s', 'Images was successfully removed');
            return redirect('/a/dashboard');
        }

        $request->session()->flash('e', 'Sorry! Could not remove the image');
        return redirect('/a/dashboard');
    }
}
