<?php
namespace App\Core;

use Illuminate\Http\Request;

class ImageStore
{
    public function addProduct(Request $request)
    {
        $file = $request->file('image');
        $fileName = 'product_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/products', $fileName);
        $request->request->add(['image-name' => $fileName]);

        return true;
    }
}