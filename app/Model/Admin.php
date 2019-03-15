<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    public function exists(Request $userData)
    {
        return
            DB::table('admins')
                ->select('id')
                ->where('email', '=', $userData->get('email'))
                ->count();
    }

    public function verify(Request $credentials)
    {
        return
            DB::table('admins')
                ->select('id')
                ->where([
                    ['email', '=', $credentials->get('email')],
                    ['password', '=', $credentials->get('password')]
                ])->first();
    }

    public function getRequests()
    {
        return
            DB::table('point_requests')
                ->select('point_requests.*',
                    'users.first_name',
                    'users.last_name',
                    'users.email',
                    'users.phone')
                ->join('users', 'point_requests.applicant_id', '=', 'users.id')
                ->where('point_requests.response', '=', 'pending')
                ->get();
    }

    public function rejectRequest(Request $request)
    {
        return
            DB::table('point_requests')
                ->where('id', '=', $request->get('request-id'))
                ->update([
                   'response'   => 'reject'
                ]);
    }

    public function acceptRequest(Request $request, User $user)
    {
        DB::beginTransaction();
        DB::table('point_requests')
            ->where('id', '=', $request->get('request-id'))
            ->update([
                'response'   => 'accept'
            ]);
        $user->addPoints($request);
        DB::commit();
    }
}
