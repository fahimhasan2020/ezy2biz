<?php

namespace App\Http\Controllers;

use App\Core\LoginValidator;
use App\Core\ReferralKeyGenerator;
use App\Core\RegistrationValidator;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request, RegistrationValidator $validator, User $user)
    {
        if (!$validator->validate($request->request)) {
            return redirect()->back();
        }
        if (!$user->exists($request->request)) {
            $user->register($request->request);
            return redirect('/u/login');
        }
        return redirect()->back();
    }

    public function login(Request $request, LoginValidator $validator, User $user)
    {
        if ($validator->validate($request->request)) {
            $userObj = $user->verify($request->request);
        }
        if (isset($userObj) && $userObj->id) {
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

    public function tree(Request $request, User $user)
    {
        $currentUserId = $request->session()->get('user');
        $userQuery = $user->get($currentUserId);
        return view('user.tree')->with('currentUser', $userQuery);
    }

    public function generateRefLink(Request $request, User $user, ReferralKeyGenerator $keygen)
    {
        $currentUserId = $request->session()->get('user');
        $request->request->add(['referrer-id' => $currentUserId]);
        $request->request->add(['referral-key' => $keygen->generateKey($request->request)]);
        $user->addRefLink($request->request);

        return redirect()->route('user.ref-link');
    }

    public function getRefLinks(Request $request, User $user)
    {
        $currentUserId = $request->session()->get('user');
        $refLinks = $user->getRefLinks($currentUserId, 'pending')->all();
        return view('user.ref-link')->with('refLinks', $refLinks);
    }
}
