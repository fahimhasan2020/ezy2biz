<?php
namespace App\Model;

use Illuminate\Support\Facades\DB;

class CronJobModel
{
    public function findJobs()
    {
        return DB::table('cron_job_schedules')
            ->select('id', 'job_type', 'issuer_id')
            ->where([
                ['job_status', '=', 'pending'],
                ['issue_datetime', '<=', date('Y-m-d H:i:s', time())]
            ])
            ->orderBy('issue_datetime')
            ->get();
    }

    public function begin()
    {
        DB::beginTransaction();
    }

    public function end()
    {
        DB::commit();
    }

    public function getUser($userId)
    {
        return DB::table('users')
            ->select('id', 'parent_id', 'step', 'is_active')
            ->where('id', '=', $userId)
            ->first();
    }

    public function referralTree($userId)
    {
        return DB::table('referral_tree as r')
            ->join('users as u', 'u.id', '=', 'r.child_id')
            ->select('r.user_id', 'u.step', DB::raw('COUNT(r.child_id) as children'))
            ->where('u.is_active', '=', true)
            ->groupBy( 'u.step', 'r.user_id')
            ->having('r.user_id', '=', $userId)
            ->get();
    }

    public function promote($userId, $step, $commission)
    {
        echo "$userId promotes to $step and gets $commission" . PHP_EOL;
        return DB::table('users')
            ->where('id', '=', $userId)
            ->update([
                'step'  => $step,
                'points'    => DB::raw("points + $commission")
            ]);
    }

    public function addCommission($userId, $commission)
    {
        echo "$userId gets $commission" . PHP_EOL;
        return DB::table('users')
            ->where('id', '=', $userId)
            ->update(['points'    => DB::raw("points + $commission")]);
    }

    public function jobComplete($jobId)
    {
        return DB::table('cron_job_schedules')
            ->where([
                ['id', '=', $jobId],
                ['job_status', '=', 'pending']
                ])
            ->update(['job_status' => 'complete']);
    }
}