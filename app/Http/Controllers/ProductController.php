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
        $request->request->add(['image-paths' => []]);
        if ($store->addProduct($request)) {
            $product->add($request->request);
            return redirect('/a/products');
        }
        return redirect()->back();
    }

    public function edit($productId, Request $request,
                         Product $product,
                         ProductValidator $validator,
                         ImageStore $store)
    {
        $query = $product->get($productId);
        $query->image_paths = json_decode($query->image_paths);

        $request->request->add(['image-paths' => $query->image_paths]);
        if ($request->has('delete-images')) {
            $request->request->add([
                'image-paths' => array_diff($request->get('image-paths'), $request->get('delete-images'))
            ]);
        }

        if($store->addProduct($request)) {
            $product->edit($productId, $request->request);
            $store->removeLeftOvers($request);
            return redirect('/a/products');
        }
    }

    public function delete(Request $request, Product $product, ImageStore $store)
    {
        $query = $product->get($request->get('id'));
        $deletableImages = json_decode($query->image_paths);

        $product->remove($request->get('id'));
        $store->removeProduct($deletableImages);

        return redirect('/a/products');
    }

    public function allProducts(Product $product) {
        $products = $product->getAll()->all();
        foreach ($products as $p) {
            $p->image_paths = json_decode($p->image_paths);
        }
        return view('admin.all-products')->with('products', $products);
    }

    public function getProduct($productId, Product $product)
    {
        $query = $product->get($productId);
        $query->image_paths = json_decode($query->image_paths);
        return view('admin.edit-product')->with('product', $query);
    }
}
