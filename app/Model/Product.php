<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\ParameterBag;

class Product extends Model
{
    public function add(ParameterBag $productData)
    {
        DB::beginTransaction();
        $productId = DB::table('products')
            ->insertGetId([
                'name'              => $productData->get('name'),
                'description'       => $productData->get('description'),
                'sale_price'        => $productData->get('sale-price'),
                'wholesale_price'   => $productData->get('wholesale-price'),
                'commission'        => $productData->get('commission')
            ]);

        DB::table('product_images')
            ->insert([
                'product_id'    => $productId,
                'image_name'    => $productData->get('image-name')
            ]);
        DB::commit();
        return true;
    }

    public function getAll()
    {
        return
            DB::table('products')
                ->join('product_images', 'products.id', '=', 'product_images.product_id')
                ->select('products.*', 'product_images.image_name')
                ->get();
    }

    public function get($productId)
    {
        return
            DB::table('products')
                ->join('product_images', 'products.id', '=', 'product_images.product_id')
                ->select('products.*', 'product_images.id as image_id', 'product_images.image_name')
                ->where('products.id', '=', $productId)
                ->get();
    }
}
