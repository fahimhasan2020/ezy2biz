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

    public function getPointRequests()
    {
        return
            DB::table('point_requests')
                ->join('users', 'point_requests.applicant_id', '=', 'users.id')
                ->select('point_requests.*',
                    'users.first_name',
                    'users.last_name',
                    'users.email',
                    'users.phone')
                ->where('point_requests.response', '=', 'pending')
                ->get();
    }

    public function rejectPointRequest(Request $request)
    {
        return
            DB::table('point_requests')
                ->where('id', '=', $request->get('request-id'))
                ->update([
                   'response'   => 'reject'
                ]);
    }

    public function acceptPointRequest(Request $request, User $user)
    {
        DB::beginTransaction();
        DB::table('point_requests')
            ->where('id', '=', $request->get('request-id'))
            ->update([
                'response'   => 'accept'
            ]);
        $user->addPoints($request->get('applicant-id'), $request->get('points'));
        DB::commit();
    }

    public function getWithdrawRequests()
    {
        return
            DB::table('withdraw_requests')
                ->join('users', 'withdraw_requests.applicant_id', '=', 'users.id')
                ->select('withdraw_requests.*',
                    'users.first_name',
                    'users.last_name',
                    'users.email',
                    'users.phone')
                ->where('withdraw_requests.response', '=', 'pending')
                ->get();
    }

    public function rejectWithdrawRequest(Request $request)
    {
        return
            DB::table('withdraw_requests')
                ->where('id', '=', $request->get('request-id'))
                ->update([
                    'response'   => 'reject'
                ]);
    }

    public function acceptWithdrawRequest(Request $request, User $user)
    {
        DB::beginTransaction();
        DB::table('withdraw_requests')
            ->where('id', '=', $request->get('request-id'))
            ->update([
                'response'      => 'accept',
                'allowed_cash'  => $request->get('cash')
            ]);
        $user->deductPoints($request->get('applicant-id'), $request->get('points'));
        DB::commit();
    }

    public function getOrders()
    {
        return
            DB::table('product_orders')
                ->join('users', 'users.id', '=', 'product_orders.buyer_id')
                ->join('products', 'products.id', '=', 'product_orders.product_id')
                ->select('product_orders.*',
                    'users.first_name',
                    'users.last_name',
                    'users.phone',
                    'users.address',
                    'products.name',
                    'products.description',
                    'products.sale_price')
                ->where('order_status', '=', 'pending')
                ->get();
    }

    public function responseOrder($orderId, $response)
    {
        return
            DB::table('product_orders')
                ->where('id', '=', $orderId)
                ->update(['order_status'   => $response]);
    }
}
