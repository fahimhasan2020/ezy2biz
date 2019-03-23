<?php
namespace App\Http\Controllers;

use App\Core\ImageStore;
use App\Core\LoginValidator;
use App\Core\ReferralKeyGenerator;
use App\Core\RegistrationValidator;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getRegistrationForm(Request $request, User $user)
    {
        $query = $user->getRefLink($request->get('ref'));
        if (!$query) {
            return view('user.register');
        }
        return view('user.register')->with('refInfo', $query);
    }

    public function register(Request $request, RegistrationValidator $validator, User $user, ImageStore $store)
    {
        if (!$validator->validate($request->request)) {
            return redirect()->back();
        }
        $request->request->add(['image-path' => '']);
        if (!$user->exists($request)) {
            $store->addUserPhoto($request);
            $user->register($request);
            return redirect('/');
        }
        return redirect()->back();
    }

    public function login(Request $request, LoginValidator $validator, User $user)
    {
        if ($validator->validate($request)) {
            $userObj = $user->verify($request);
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
        return redirect('/');
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
        $user->addRefLink($request);

        return redirect()->route('user.ref-link');
    }

    public function getRefLinks(Request $request, User $user)
    {
        $currentUserId = $request->session()->get('user');
        $refLinks = $user->getRefLinks($currentUserId, 'pending')->all();
        return view('user.ref-link')->with('refLinks', $refLinks);
    }

    public function getAccount(Request $request, User $user)
    {
        $currentUserId = $request->session()->get('user');
        $query = $user->getUser($currentUserId);
        return view('user.account')
            ->with('user', $query)
            ->with('action', strtolower($request->get('action')));
    }

    public function transferPoints(Request $request, User $user)
    {
        $senderId = $request->session()->get('user');
        if ($user->checkPointsAvailable($senderId, $request->get('amount'))) {
            $user->transferPoints($senderId, $request);
            return redirect('/u/account');
        }
        return redirect('/u/account?action=transfer');
    }

    public function requestPoints(Request $request, User $user)
    {
        $userId = $request->session()->get('user');
        $user->requestPoints($userId, $request);
        return redirect('u/account');
    }

    public function requestWithdrawal(Request $request, User $user)
    {
        $userId = $request->session()->get('user');
        if ($user->checkPointsAvailable($userId, $request->get('amount'))) {
            $user->withdrawalRequest($userId, $request);
            return redirect('u/account');
        }
        return redirect('/u/account?action=withdraw');
    }
}
