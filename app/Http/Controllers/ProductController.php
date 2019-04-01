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
            if ($product->add($request)) {
                $request->session()->flash('s', 'Congratulations! Product was successfully added');
                return redirect('/a/products?page=1');
            }
        }

        $request->session()->flash('e', 'Sorry! Product could not be added');
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
            if ($product->edit($productId, $request)) {
                $store->removeLeftOvers($request);

                $request->session()->flash('s', 'Product was updated successfully');
                return redirect('/a/products?page=1');
            }
        }

        $request->session()->flash('e', 'Sorry! Product could not be updated');
        return redirect()->back();
    }

    public function delete(Request $request, Product $product, ImageStore $store)
    {
        $query = $product->get($request->get('id'));
        $deletableImages = json_decode($query->image_paths);

        if ($product->remove($request->get('id'))) {
            $store->removeProduct($deletableImages);
            $request->session()->flash('s', 'Product was successfully deleted');
        } else {
            $request->session()->flash('e', 'Sorry! Product could not be deleted');
        }

        return redirect('/a/products?page=1');
    }

    public function adminAllProducts(Request $request, Product $product)
    {
        if (!$request->get('page') || !(int) $request->get('page')) {
            return redirect('/a/products?page=1');
        } else {
            $curPage = (int) $request->get('page');
        }

        $count = $product->countTotal();
        $perPage = 10;
        $totalPages = ceil($count / $perPage);
        $offset = $perPage * ($curPage - 1);

        if (1 <= $curPage - 1) {
            $prevPage = $curPage - 1;
        } else {
            $prevPage = null;
        }

        if ($curPage + 1 <= $totalPages) {
            $nextPage = $curPage + 1;
        } else {
            $nextPage = null;
        }

        $products = $product->paginate($perPage, $offset)->all();

        foreach ($products as $p) {
            $p->image_paths = json_decode($p->image_paths);
        }

        return view('admin.all-products')
            ->with('products', $products)
            ->with('totalPages', $totalPages)
            ->with('curPage', $curPage)
            ->with('prevPage', $prevPage)
            ->with('nextPage', $nextPage);
    }

    public function userAllProducts(Request $request, Product $product)
    {
        if (!$request->get('page') || !(int) $request->get('page')) {
            return redirect('/products?page=1');
        } else {
            $curPage = (int) $request->get('page');
        }

        $count = $product->countTotal();
        $perPage = 9;
        $totalPages = ceil($count / $perPage);
        $offset = $perPage * ($curPage - 1);

        if (1 <= $curPage - 1) {
            $prevPage = $curPage - 1;
        } else {
            $prevPage = null;
        }

        if ($curPage + 1 <= $totalPages) {
            $nexPage = $curPage + 1;
        } else {
            $nexPage = null;
        }

        $products = $product->paginate($perPage, $offset)->all();

        foreach ($products as $p) {
            $p->image_paths = json_decode($p->image_paths);
        }

        return view('product.all')
            ->with('products', $products)
            ->with('totalPages', $totalPages)
            ->with('curPage', $curPage)
            ->with('prevPage', $prevPage)
            ->with('nextPage', $nexPage);
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

                $request->session()->flash('s', 'Congratulation! You have successfully bought the product');
                return redirect('/u/account');
            }

            $request->session()->flash('e', 'Sorry! You do not have sufficient points to buy the product');
            return redirect()->back();
        }

        $request->session()->flash('e', 'Something went wrong! Product buy was unsuccessful');
        return redirect()->back();
    }

    public function singleProduct($productId, Product $product)
    {
        $query = $product->get($productId);
        $query->image_paths = json_decode($query->image_paths);
        return view('product.single')->with('product', $query);
    }
}
