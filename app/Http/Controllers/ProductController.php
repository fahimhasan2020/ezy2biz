<?php

namespace App\Http\Controllers;

use App\Core\ImageStore;
use App\Core\ProductValidator;
use App\Model\Product;
use App\Model\User;
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
            $product->add($request);
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
                'image-paths' => array_values(array_diff($request->get('image-paths'), $request->get('delete-images')))
            ]);
        }

        if($store->addProduct($request)) {
            $product->edit($productId, $request);
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

    public function adminAllProducts(Product $product)
    {
        $products = $product->getAll()->all();
        foreach ($products as $p) {
            $p->image_paths = json_decode($p->image_paths);
        }

        return view('admin.all-products')->with('products', $products);
    }

    public function userAllProducts(Product $product)
    {
        $products = $product->getAll()->all();
        foreach ($products as $p) {
            $p->image_paths = json_decode($p->image_paths);
        }
        return view('product.all')->with('products', $products);
    }

    public function getProduct($productId, Product $product)
    {
        $query = $product->get($productId);
        $query->image_paths = json_decode($query->image_paths);
        return view('admin.edit-product')->with('product', $query);
    }

    public function getProductBuyPage($productId, Request $request, Product $product, User $user)
    {
        $userQuery = $user->getUser($request->session()->get('user'));
        $productQuery = $product->get($productId);
        $productQuery->image_paths = json_decode($productQuery->image_paths);
        return view('user.product-buy')->with('user', $userQuery)->with('product', $productQuery);
    }

    public function buyProduct($productId, Request $request, Product $product, User $user)
    {
        $userQuery = $user->getUser($request->session()->get('user'));
        $productQuery = $product->get($productId);
        $totalSalePrice = $productQuery->sale_price * $request->get('qty');
        $totalWholesalePrice = $productQuery->wholesale_price * $request->get('qty');
        if ($request->get('password') === $userQuery->password) {
            $request->request->add(['buyer-id'     => $userQuery->id]);
            $request->request->add(['product-id'   => $productId]);
            $request->request->add(['cost'         => $totalSalePrice]);
            $request->request->add(['commission'   => $productQuery->commission]);
            $request->request->add(['wholesale'    => $totalWholesalePrice]);
            $request->request->add(['referrer-id'  => $userQuery->referrer_id]);

            if ($user->checkPointsAvailable($userQuery->id, $totalSalePrice)) {
                $product->sell($request, $user);
                return redirect('/products');
            }
        }

        return redirect()->back();
    }

    public function singleProduct($productId, Product $product)
    {
        $query = $product->get($productId);
        $query->image_paths = json_decode($query->image_paths);
        return view('product.single')->with('product', $query);
    }
}
