<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        $newUserId = DB::table('users')
            ->insertGetId([
                'first_name'    => $userData->get('first-name'),
                'last_name'     => $userData->get('last-name'),
                'phone'         => $userData->get('phone'),
                'address'       => $userData->get('address'),
                'email'         => $userData->get('email'),
                'password'      => $userData->get('password'),
                'parent_id'     => $userData->get('parent-id'),
                'referrer_id'   => $userData->get('referrer-id')
            ]);

        DB::table('referral_links')
            ->where('referral_key', '=', $userData->get('ref'))
            ->update(['status' => 'complete']);

        $time = time();
        DB::table('cron_job_schedules')
            ->insert([
                'job_type'      => 'reg',
                'issuer_id'     => $newUserId,
                'issue_date'    => date('Y-m-d', $time),
                'issue_time'    => date('H:i:s', $time),
            ]);
        DB::commit();
    }

    public function verify(Request $credentials)
    {
        return
            DB::table('users')
                ->select('id')
                ->where([
                    ['email', '=', $credentials->get('email')],
                    ['password', '=', $credentials->get('password')]
                ])->first();
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
                ->select('first_name', 'last_name', 'points', 'is_active')
                ->where('id', '=', $userId)
                ->first();
    }

    public function checkPointsAvailable($userId, $amount)
    {
        return
            DB::table('users')
                ->where([
                    ['id', '=', $userId],
                    ['points', '>=', $amount]
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

    public function addPoints(Request $request)
    {
        return
            DB::table('users')
                ->where('id', '=', $request->get('applicant-id'))
                ->increment('points', $request->get('points'));
    }
}
