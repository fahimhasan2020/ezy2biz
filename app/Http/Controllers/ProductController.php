<?php

namespace App\Http\Controllers;

use App\Core\ImageStore;
use App\Core\ProductValidator;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add(Request $request,
                        ProductValidator $validator,
                        ImageStore $store,
                        Product $product)
    {
        if ($store->addProduct($request)) {
            $product->add($request->request);
            return redirect('/a/products');
        }
        return redirect()->back();
    }

    public function edit()
    {

    }

    public function allProducts(Product $product) {
        $products = $product->getAll();

        return view('admin.all-products')->with('products', $products->all());
    }

    public function getProduct($productId, Product $product)
    {
        $product = $product->get($productId);
        return view('admin.edit-product')->with('product', $product->all());
    }
}
