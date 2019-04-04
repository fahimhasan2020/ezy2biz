<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    public function exists(Request $userData)
    {
        return
            DB::table('users')
                ->select('id')
                ->where('email', '=', $userData->get('email'))
                ->count();
    }

    public function register(Request $userData)
    {
        $hashedPass = Hash::make($userData->get('password'));
        $newUserId = DB::table('users')
            ->insertGetId([
                'first_name'    => $userData->get('first-name'),
                'last_name'     => $userData->get('last-name'),
                'phone'         => $userData->get('phone'),
                'address'       => $userData->get('address'),
                'email'         => $userData->get('email'),
                'password'      => $hashedPass,
                'parent_id'     => $userData->get('parent-id'),
                'referrer_id'   => $userData->get('referrer-id'),
                'photo'         => $userData->get('image-path')
            ]);

        if ($userData->get('ref')) {
            DB::table('referral_links')
                ->where('referral_key', '=', $userData->get('ref'))
                ->update(['status' => 'complete']);
        }
        return $newUserId;
    }

    public function verify(Request $credentials)
    {
        $user = DB::table('users')
            ->select('id', 'password' , 'first_name', 'last_name')
            ->where('email', '=', $credentials->get('email'))
            ->first();

        if (Hash::check($credentials->get('password'), $user->password)) {
            return $user;
        }

        return null;
    }

    public function verifyPassword($id, Request $credentials)
    {
        $user = DB::table('users')
            ->where('id', '=', $id)
            ->first();

        if (Hash::check($credentials->get('password'), $user->password)) {
            return $user;
        }

        return null;
    }

    public function get($userId)
    {
        return
            DB::table('users')
                ->select('id', 'first_name', 'last_name', 'email', 'is_active')
                ->where('id', '=', $userId)
                ->first();
    }

    public function addRefLink(Request $referralData)
    {
        return
            DB::table('referral_links')
                ->insert([
                    'referrer_id'   => $referralData->get('referrer-id'),
                    'parent_id'     => $referralData->get('parent-id'),
                    'referral_key' => $referralData->get('referral-key')
                ]);
    }

    public function getRefLinks($userId, $status)
    {
        return
            DB::table('referral_links')
                ->join('users', 'referral_links.parent_id', '=', 'users.id')
                ->select(
                    'referral_links.id',
                    'referral_links.referral_key',
                    'referral_links.parent_id',
                    'referral_links.status',
                    'users.first_name as parent_fn',
                    'users.last_name as parent_ln',
                    'users.email as parent_email'
                )->where([
                    ['referral_links.referrer_id', '=', $userId],
                    ['referral_links.status', '=', $status]
                ])
                ->orderByDesc('referral_links.timestamp')
                ->get();
    }

    public function getRefLink($refKey)
    {
        return
            DB::table('referral_links')
                ->select(
                    'r.id as r_id',
                    'r.first_name as r_fn',
                    'r.last_name as r_ln',
                    'p.id as p_id',
                    'p.first_name as p_fn',
                    'p.last_name as p_ln',
                    'referral_key')
                ->join('users as r', 'r.id', '=', 'referral_links.referrer_id')
                ->join('users as p', 'p.id', '=', 'referral_links.parent_id')
                ->where([['referral_key', '=', $refKey], ['status', '=', 'pending']])
                ->first();
    }

    public function getUser($userId)
    {
        return
            DB::table('users')
                ->where('id', '=', $userId)
                ->first();
    }

    public function getUserFull($userId)
    {
        return
            DB::table('users as u')
                ->leftJoin('users as pu', 'u.parent_id', '=', 'pu.id')
                ->leftJoin('users as ru', 'u.referrer_id', '=', 'ru.id')
                ->select('u.id', 'u.first_name', 'u.last_name', 'u.phone', 'u.email', 'u.step', 'u.points',
                    'u.photo', 'u.address', 'pu.id as parent_id', 'pu.first_name as parent_fn',
                    'pu.last_name as parent_ln', 'ru.id as referrer_id', 'ru.first_name as referrer_fn',
                    'ru.last_name as referrer_ln')
                ->where('u.id', '=', $userId)
                ->first();
    }

    public function adminEdit($id, Request $request)
    {
        return
            DB::table('users')
                ->where('id', '=', $id)
                ->update([
                    'referrer_id'   => $request->get('referrer-id'),
                    'parent_id'     => $request->get('parent-id')
                ]);
    }

    public function remove($id)
    {
        return
            DB::table('users')
                ->where('id', '=', $id)
                ->delete();
    }

    public function checkPointsAvailable($userId, $amount)
    {
        $minBalance = 10 + (float) $amount;
        return
            DB::table('users')
                ->where([
                    ['id', '=', $userId],
                    ['points', '>=', $minBalance]
                ])->count();
    }

    public function transferPoints($senderId, Request $request)
    {
        DB::beginTransaction();
        DB::table('users')
            ->where('id', '=', $senderId)
            ->decrement('points', $request->get('amount'));
        DB::table('users')
            ->where('id', '=', $request->get('recipient'))
            ->increment('points', $request->get('amount'));
        DB::commit();
    }

    public function requestPoints($applicantId, Request $request)
    {
        return
            DB::table('point_requests')
                ->insert([
                    'applicant_id'  => $applicantId,
                    'amount'        => $request->get('amount'),
                    'bkash_no'      => $request->get('bkash-num')
                ]);
    }

    public function addPoints($userId, $points)
    {
        return
            DB::table('users')
                ->where('id', '=', $userId)
                ->increment('points', $points);
    }

    public function deductPoints($userId, $points)
    {
        return
            DB::table('users')
                ->where('id', '=', $userId)
                ->decrement('points', $points);
    }

    public function withdrawalRequest($applicantId, Request $request)
    {
        return
            DB::table('withdraw_requests')
                ->insert([
                    'applicant_id'  => $applicantId,
                    'amount'        => $request->get('amount'),
                    'bkash_no'      => $request->get('bkash-num')
                ]);
    }

    public function getAll()
    {
        return
            DB::table('users as u')
                ->leftJoin('users as pu', 'u.parent_id', '=', 'pu.id')
                ->leftJoin('users as ru', 'u.referrer_id', '=', 'ru.id')
                ->select('u.id', 'u.first_name', 'u.last_name', 'u.phone', 'u.email', 'u.step', 'u.points',
                    'pu.id as parent_id', 'pu.first_name as parent_fn', 'pu.last_name as parent_ln',
                    'ru.id as referrer_id', 'ru.first_name as referrer_fn', 'ru.last_name as referrer_ln')
                ->orderBy('u.first_name', 'asc')
                ->orderBy('u.last_name', 'asc')
                ->get();
    }

    public function edit($userId, Request $userData)
    {
        $updates = [
            'first_name'    => $userData->get('first-name'),
            'last_name'     => $userData->get('last-name'),
            'phone'         => $userData->get('phone'),
            'address'       => $userData->get('address')
        ];
        if (!empty($userData->get('image-path'))) {
            $updates['photo'] = $userData->get('image-path');
        }
        return
            DB::table('users')
                ->where('id', '=', $userId)
                ->update($updates);
    }

    public function getTree($userId)
    {
        return
            DB::table('referral_tree as t')
                ->join('users as u', 't.child_id', '=', 'u.id')
                ->select('u.id', 'u.first_name', 'u.last_name', 'u.step', 'u.is_active', 'u.parent_id', 't.level')
                ->where('t.user_id', '=', $userId)
                ->orderBy('t.level')
                ->get();
    }

    public function countTotal()
    {
        return DB::table('users')->select('id')->count();
    }

    public function paginate($limit, $offset)
    {
        return
            DB::table('users as u')
                ->leftJoin('users as pu', 'u.parent_id', '=', 'pu.id')
                ->leftJoin('users as ru', 'u.referrer_id', '=', 'ru.id')
                ->select('u.id', 'u.first_name', 'u.last_name', 'u.phone', 'u.email', 'u.step', 'u.points',
                    'pu.id as parent_id', 'pu.first_name as parent_fn', 'pu.last_name as parent_ln',
                    'ru.id as referrer_id', 'ru.first_name as referrer_fn', 'ru.last_name as referrer_ln')
                ->orderBy('u.first_name', 'asc')
                ->orderBy('u.last_name', 'asc')
                ->limit($limit)
                ->offset($offset)
                ->get();
    }

    public function makeActive($userId)
    {
        DB::beginTransaction();

        $isActive = DB::table('users')
            ->where([
                ['id', '=', $userId],
                ['is_active', '=', false],
                ['points', '>=', 10]
            ])
            ->update([
                'is_active' => true
            ]);

        if ($isActive) {
            DB::table('cron_job_schedules')
                ->insert([
                    'job_type' => 'promote',
                    'issuer_id' => $userId,
                    'issue_datetime' => date('Y-m-d H:i:s', time())
                ]);
        }
        DB::commit();
    }

    public function begin()
    {
        DB::beginTransaction();
    }

    public function finish()
    {
        DB::commit();
    }

    public function addToTree($parentId, $childId, $level)
    {
        return
            DB::table('referral_tree')
                ->insert([
                    'user_id'    => $parentId,
                    'child_id'   => $childId,
                    'level'      => $level
                ]);
    }

    public function changeCredentials($userId, Request $request)
    {
        $updates = [];
        if ($request->has('change-email') && !empty($request->get('change-email'))) {
            $updates['email'] = $request->get('change-email');
        }
        if ($request->has('change-password') && !empty($request->get('change-password'))) {
            $hashedPass = Hash::make($request->get('change-password'));
            $updates['password'] = $hashedPass;
        }

        return DB::table('users')->where('id', '=', $userId)->update($updates);
    }

    public function getTopUsers()
    {
        return DB::table('users')
            ->select('first_name', 'last_name', 'step', 'points', 'photo')
            ->orderBy('points', 'desc')
            ->orderBy('step', 'desc')
            ->limit(10)
            ->get();
    }

    public function getBankingAccounts()
    {
        return DB::table('banking_accounts')->get();
    }

    public function checkTree($userId)
    {
        return DB::table('referral_tree')
            ->select('child_id')
            ->where([
                ['user_id', '=', $userId],
                ['level', '=', 2]
            ])
            ->count();
    }

    public function checkRefLinks($referrerId, $parentId)
    {
        return DB::table('referral_links')
            ->where([
                ['referrer_id', '=', $referrerId],
                ['parent_id', '=', $parentId]
            ])
            ->count();
    }

    public function getSlides()
    {
        return DB::table('landing_page_slides')
            ->get();
    }
}
