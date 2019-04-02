<?php
namespace App\Core;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageStore
{
    public function addProduct(Request $request)
    {
        if (!$request->hasFile('images')) {
            return true;
        }
        $imagePaths = [];
        $files = $request->file('images');
        foreach($files as $file) {
            $imagePaths[] = $file->store('public/products');
        }
        $request->request->add(['image-paths' => array_merge($request->get('image-paths'), $imagePaths)]);
        return true;
    }

    public function removeLeftOvers(Request $request)
    {
        if (!$request->has('delete-images')) {
            return true;
        }

        $deletableImages = $request->get('delete-images');
        foreach ($deletableImages as $deletable) {
            Storage::delete($deletable);
        }
        return true;
    }

    public function removeProduct(Array $deletableImages)
    {
        if (empty($deletableImages)) {
            return true;
        }

        foreach ($deletableImages as $deletable) {
            Storage::delete($deletable);
        }
        return true;
    }

    public function addUserPhoto(Request $request)
    {
        $file = $request->file('image');
        $path = $file->store('public/users');
        $request->request->add(['image-path' => $path]);
        return true;
    }

    public function removeUserPhoto($path)
    {
        return Storage::delete($path);
    }

    public function addSlideImages(Request $request)
    {
        if (!$request->hasFile('images')) {
            return true;
        }

        $imagePaths = [];
        $files = $request->file('images');
        foreach($files as $file) {
            $imagePaths[] = $file->store('public/slides');
        }
        $request->request->add(['image-paths' =>  $imagePaths]);
        return true;
    }

    public function removeImage($path)
    {
        return Storage::delete($path);
    }
}