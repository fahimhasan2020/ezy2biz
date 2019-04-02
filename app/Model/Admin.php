<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    public function getAdmin($adminId)
    {
        return DB::table('admins')
            ->where('id', '=', $adminId)
            ->first();
    }

    public function editAdmin($adminId, Request $request)
    {
        return DB::table('admins')
            ->where('id', '=', $adminId)
            ->update([
                'first_name'    => $request->get('first-name'),
                'last_name'     => $request->get('last-name')
            ]);
    }

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
                ->select('id', 'first_name', 'last_name')
                ->where([
                    ['email', '=', $credentials->get('email')],
                    ['password', '=', $credentials->get('password')]
                ])->first();
    }

    public function verifyPassword($adminId, $password)
    {
        return DB::table('admins')
            ->where([
                ['id', '=', $adminId],
                ['password', '=', $password]
            ])->first();
    }

    public function changeCredentials($userId, Request $request)
    {
        $updates = [];
        if ($request->has('change-email') && !empty($request->get('change-email'))) {
            $updates['email'] = $request->get('change-email');
        }
        if ($request->has('change-password') && !empty($request->get('change-password'))) {
            $updates['password'] = $request->get('change-password');
        }

        return DB::table('admins')->where('id', '=', $userId)->update($updates);
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
        $user->makeActive($request->get('applicant-id'));
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

    public function getBankingAccounts()
    {
        return
            DB::table('banking_accounts')->get();
    }

    public function editBkash(Request $request)
    {
        $idQuery = DB::table('banking_accounts')
            ->select('id')
            ->where('account_name', '=', 'bkash')
            ->first();

        if (!$idQuery) {
            return DB::table('banking_accounts')
                ->insert([
                    'account_name' => 'bkash',
                    'account_number' => $request->get('bkash')
                ]);
        } else {
            return DB::table('banking_accounts')
                ->where('id', '=', $idQuery->id)
                ->update(['account_number' => $request->get('bkash')]);
        }
    }

    public function editRocket(Request $request)
    {
        $idQuery = DB::table('banking_accounts')
            ->select('id')
            ->where('account_name', '=', 'rocket')
            ->first();

        if (!$idQuery) {
            return DB::table('banking_accounts')
                ->insert([
                    'account_name' => 'rocket',
                    'account_number' => $request->get('rocket')
                ]);
        } else {
            return DB::table('banking_accounts')
                ->where('id', '=', $idQuery->id)
                ->update(['account_number' => $request->get('rocket')]);
        }
    }

    public function countPointRequests()
    {
        return DB::table('point_requests')
            ->select('id')
            ->where('response', '=', 'pending')
            ->count();
    }

    public function countProductOrders()
    {
        return DB::table('product_orders')
            ->select('id')
            ->where('order_status', '=', 'pending')
            ->count();
    }

    public function countWithdrawRequests()
    {
        return DB::table('withdraw_requests')
            ->select('id')
            ->where('response', '=', 'pending')
            ->count();
    }

    public function getSlideImages()
    {
        return DB::table('landing_page_slides')
            ->get();
    }

    public function addImages(Array $images)
    {
        $imagePaths = [];

        if (!empty ($images)) {
            foreach ($images as $image) {
                $imagePaths[] = ['image_path' => $image];
            }
        }

        return DB::table('landing_page_slides')
            ->insert($imagePaths);
    }

    public function deleteImage($id)
    {
        return DB::table('landing_page_slides')
            ->where('id', '=', $id)
            ->delete();
    }
}
