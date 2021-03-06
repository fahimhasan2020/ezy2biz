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
            $refInfo = [
                'p_fn' => '', 'p_ln' => '', 'p_id' => '', 'r_fn' => '', 'r_ln' => '', 'r_id' => ''
            ];
            return view('user.register')->with('refInfo', $refInfo);
        }

        if ($user->checkTree($query->p_id) >= 2) {
            $request->session()->flash('e', 'Sorry the parent user is already full. Register under another user');
            return redirect()->back();
        }

        $refInfo = [
            'p_fn' => $query->p_fn, 'p_ln' => $query->p_ln, 'p_id' => $query->p_id,
            'r_fn' => $query->r_fn, 'r_ln' => $query->r_ln, 'r_id' => $query->r_id
        ];
        return view('user.register')->with('refInfo', $refInfo);
    }

    public function register(Request $request, RegistrationValidator $validator, User $user, ImageStore $store)
    {
        if (!$validator->validate($request->request)) {
            $request->session()->flash('e', 'Sorry! Password confirmation failed.');
            return redirect()->back();
        }

        if ($user->checkTree($request->get('parent-id')) >= 2) {
            $request->session()->flash('e', 'Sorry the parent user is already full. Register under another user');
            return redirect()->back();
        }

        $request->request->add(['image-path' => '']);
        if (!$user->exists($request)) {
            if ($request->hasFile('image')) {
                $store->addUserPhoto($request);
            }

            $user->begin();
            $newUserId = $user->register($request);
            $this->populateTree($newUserId, $user);
            $user->finish();

            $request->session()->flash('s', 'Congratulations! User registration is successful');
            return redirect('/');
        }

        $request->session()->flash('e', 'Sorry! User registration failed');
        return redirect()->back();
    }

    public function login(Request $request, LoginValidator $validator, User $user)
    {
        $validator->validate($request);
        $userObj = $user->verify($request);

        if (isset($userObj) && $userObj->id) {
            $request->session()->flush();
            $request->session()->regenerateToken();
            $request->session()->put('user', $userObj->id);
            $request->session()->put('user-name', "{$userObj->first_name} {$userObj->last_name}");

            $request->session()->flash('s', 'Login successful! Welcome!');
            return redirect('/u/account');
        }
        //Show unsuccessful login
        $request->session()->flash('e', 'Login failed! Email/Password did not match');
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
        $curUser = $user->getUser($currentUserId);
        $tree = $user->getTree($currentUserId)->all();

        $t = array_fill(0, 31, null);
        $t[0] = $curUser;

        for ($i = 0; $i <= 30; $i++) {
            if (is_object($t[$i])) {
                $t[$i * 2 + 1] = $t[$i]->id;
                $t[$i * 2 + 2] = $t[$i]->id;
                foreach ($tree as $key => $child) {
                    if ($child->parent_id === $t[$i]->id) {
                        if (!is_object($t[$i * 2 + 1])) {
                            $t[$i * 2 + 1] = $child;
                            unset($tree[$key]);
                        } elseif (!is_object($t[$i * 2 + 2])) {
                            $t[$i * 2 + 2] = $child;
                            unset($tree[$key]);
                        }
                    }
                }
            }
        }

        return view('user.tree')->with('currentUser', $curUser)->with('tree', $t);
    }

    public function generateRefLink(Request $request, User $user, ReferralKeyGenerator $keygen)
    {
        $currentUserId = $request->session()->get('user');

        if ($user->checkRefLinks($currentUserId, $request->get('parent-id')) >= 2 ) {
            $request->session()->flash('e', 'Can not generate referral link! May be you have already generated two referral links for this parent.');
            return redirect('/u/tree');
        }

        $request->request->add(['referrer-id' => $currentUserId]);
        $request->request->add(['referral-key' => $keygen->generateKey($request->request)]);
        if ($user->addRefLink($request)) {
            $request->session()->flash('s', 'Referral link was successfully generated');
            return redirect('/u/ref-link');
        }

        $request->session()->flash('e', 'Sorry! Could not generate referral link');
        return redirect()->back();
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
        $bankingAccounts = $user->getBankingAccounts();

        return view('user.account')
            ->with('user', $query)
            ->with('action', strtolower($request->get('action')))
            ->with('bankingAccounts', $bankingAccounts);
    }

    public function transferPoints(Request $request, User $user)
    {
        $senderId = $request->session()->get('user');
        if ($user->verifyPassword($senderId, $request)) {
            if ($user->checkPointsAvailable($senderId, $request->get('amount'))) {
                $user->transferPoints($senderId, $request);
                $user->makeActive($request->get('recipient'));

                $request->session()->flash('s', 'Congratulations! Point transfer was successful');
                return redirect('/u/account');
            } else {
                $request->session()->flash('e', 'Sorry! You do not have sufficient points');
                return redirect('/u/account?action=transfer');
            }
        }

        $request->session()->flash('e', 'Sorry! Your password did not match');
        return redirect('/u/account?action=transfer');
    }

    public function requestPoints(Request $request, User $user)
    {
        $userId = $request->session()->get('user');
        if ($user->verifyPassword($userId, $request)) {
            $user->requestPoints($userId, $request);

            $request->session()->flash('s', 'Point request was sent successfully');
            return redirect('u/account');
        }

        $request->session()->flash('e', 'Sorry! Your password did not match');
        return redirect('/u/account?action=request');
    }

    public function requestWithdrawal(Request $request, User $user)
    {
        $userId = $request->session()->get('user');
        if ($user->verifyPassword($userId, $request)) {
            if ($user->checkPointsAvailable($userId, $request->get('amount'))) {
                $user->withdrawalRequest($userId, $request);

                $request->session()->flash('s', 'Cash withdraw request was sent successfully');
                return redirect('u/account');
            }

            $request->session()->flash('e', 'Sorry! You do not have sufficient points');
            return redirect('/u/account?action=withdraw');
        }

        $request->session()->flash('e', 'Sorry! Your password did not match');
        return redirect('/u/account?action=withdraw');
    }

    public function getEditAccountPage(Request $request, User $user)
    {
        $userId = $request->session()->get('user');
        $query = $user->getUser($userId);
        return view('user.edit-account')->with('user', $query);
    }

    public function editAccount(Request $request, User $user, ImageStore $store)
    {
        $userId = $request->session()->get('user');
        if ($request->hasFile('image')) {
            $query = $user->getUser($userId);
            $store->removeUserPhoto($query->photo);
            if ($store->addUserPhoto($request)) {
                $user->edit($userId,$request);

                $request->session()->flash('s', 'Congratulations! Your account is updated');
                return redirect('/u/account');
            }
        } else {
            $user->edit($userId, $request);

            $request->session()->flash('s', 'Congratulations! Your account is updated');
            return redirect('/u/account');
        }

        $request->session()->flash('e', 'Sorry! Your account could not be updated');
        return redirect()->back();
    }

    private function populateTree($newUserId, User $user)
    {
        $issuer = $user->getUser($newUserId);

        $parentLvl2 = $user->getUser($issuer->parent_id);
        if (isset($parentLvl2)) {
            $user->addToTree($parentLvl2->id, $issuer->id, 2);

            $parentLvl3 = $user->getUser($parentLvl2->parent_id);
        }

        if (isset($parentLvl3)) {
            $user->addToTree($parentLvl3->id, $issuer->id, 3);

            $parentLvl4 = $user->getUser($parentLvl3->parent_id);
        }

        if (isset($parentLvl4)) {
            $user->addToTree($parentLvl4->id, $issuer->id, 4);

            $parentLvl5 = $user->getUser($parentLvl4->parent_id);
        }

        if (isset($parentLvl5)) {
            $user->addToTree($parentLvl5->id, $issuer->id, 5);
        }
    }

    public function getSettings(Request $request, User $user)
    {
        $userId = $request->session()->get('user');
        $query = $user->getUser($userId);

        return view('user.settings')->with('user', $query);
    }

    public function editSettings(Request $request, User $user)
    {
        $userId = $request->session()->get('user');
        if ($user->verifyPassword($userId, $request)) {
            $user->changeCredentials($userId, $request);

            $request->session()->flush();

            $request->session()->flash('s', 'Your account settings were changed. Please login again');
            return redirect('/');
        }

        $request->session()->flash('e', 'Something went wrong! Account settings could not be updated');
        return redirect()->back();
    }

    public function commissionHistory(Request $request, User $user)
    {
        $userId = $request->session()->get('user');
        $histories = $user->getCommissionHistory($userId)->all();
        return view('user.history')->with('histories', $histories);
    }
}
