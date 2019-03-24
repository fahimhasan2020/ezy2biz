<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\ParameterBag;

class Product extends Model
{
    public function add(Request $productData)
    {
        $imagePaths = json_encode($productData->get('image-paths'));
        DB::table('products')
            ->insert([
                'name'              => $productData->get('name'),
                'description'       => $productData->get('description'),
                'sale_price'        => $productData->get('sale-price'),
                'wholesale_price'   => $productData->get('wholesale-price'),
                'commission'        => $productData->get('commission'),
                'image_paths'       => $imagePaths
            ]);

        return true;
    }

    public function edit($productId, Request $productData)
    {
        $imagePaths = json_encode($productData->get('image-paths'));
        DB::table('products')
            ->where('id', '=', $productId)
            ->update([
                'name'              => $productData->get('name'),
                'description'       => $productData->get('description'),
                'sale_price'        => $productData->get('sale-price'),
                'wholesale_price'   => $productData->get('wholesale-price'),
                'commission'        => $productData->get('commission'),
                'image_paths'       => $imagePaths
            ]);

        return true;
    }

    public function remove($productId)
    {
        return
            DB::table('products')
                ->where('id', '=', $productId)
                ->delete();
    }

    public function getAll()
    {
        return DB::table('products')->get();
    }

    public function get($productId)
    {
        return
            DB::table('products')
                ->where('id', '=', $productId)
                ->first();
    }

    public function sell(Request $request, User $user)
    {
        DB::beginTransaction();
        DB::table('product_orders')
            ->insert([
                'buyer_id'      => $request->get('buyer-id'),
                'product_id'    => $request->get('product-id'),
                'quantity'      => $request->get('qty'),
                'total_cost'    => $request->get('cost')
            ]);
        $user->deductPoints($request->get('buyer-id'), $request->get('cost'));
        $commission = $request->get('wholesale') * $request->get('commission') / 100;
        $user->addPoints($request->get('referrer-id'), $commission);
        DB::commit();
    }

    public function countTotal()
    {
        return DB::table('products')->select('id')->count();
    }

    public function paginate($limit, $offset)
    {
        return
            DB::table('products')
                ->limit($limit)
                ->offset($offset)
                ->get();
    }
}
