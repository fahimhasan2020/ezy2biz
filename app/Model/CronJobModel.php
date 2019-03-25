<?php
namespace App\Model;

use Illuminate\Support\Facades\DB;

class CronJobModel
{
    public function searchJob($datetime)
    {
        return
            DB::table('cron_job_schedules')
                ->where([
                    ['issue_datetime', '<=', $datetime],
                    ['job_status', '=', 'pending']
                ])
                ->orderBy('issue_datetime')
                ->get();
    }

    public function getUser($userId)
    {
        return DB::table('users')
            ->where('id', '=', $userId)
            ->select('id', 'parent_id', 'referrer_id', 'is_active')
            ->first();
    }

    public function addPoints($userId, $amount)
    {
        return
            DB::table('users')
                ->where('id', '=', $userId)
                ->increment('points', $amount);
    }

    public function totalChildUsers($userId)
    {
        return
            DB::table('referral_tree as r')
                ->join('users as u','u.id', '=', 'r.child_id')
                ->select('u.id', 'u.step', 'u.is_active')
                ->where([
                    ['r.user_id', '=', $userId],
                    ['u.step', '=', 1],
                    ['u.is_active', '=', true]
                ])
                ->count();
    }

    public function totalStep2ChildUsers($userId)
    {
        return
            DB::table('referral_tree as r')
                ->join('users as u','u.id', '=', 'r.child_id')
                ->select('u.id', 'u.step', 'u.is_active')
                ->where([
                    ['r.user_id', '=', $userId],
                    ['u.step', '=', 2]
                ])
                ->count();
    }

    public function schedulePromoteJob($userId)
    {
        $datetime = date('Y-m-d H:i:s', time());
        return
            DB::table('cron_job_schedules')
                ->insert([
                    'job_type'          => 'promote',
                    'issuer_id'         => $userId,
                    'issue_datetime'    => $datetime
                ]);
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

    public function jobSucceed($jobId)
    {
        return
            DB::table('cron_job_schedules')
                ->where('id', '=', $jobId)
                ->update(['job_status'    => 'finish']);
    }

    public function promote($userId, $step)
    {
        return
            DB::table('users')
                ->where('id', '=', $userId)
                ->update(['step' => $step]);
    }

    public function begin()
    {
        DB::beginTransaction();
    }

    public function finish()
    {
        DB::commit();
    }
}