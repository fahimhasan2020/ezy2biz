<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\ParameterBag;

class Product extends Model
{
    public function add(ParameterBag $productData)
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

    public function edit($productId, ParameterBag $productData)
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
}
