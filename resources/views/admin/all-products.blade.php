<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>This is Admin All Products page</h1>
<hr>
<ul>
    <li><a href="/a/product/1">Single Product</a></li>
    <li><a href="/a/product/1/edit">Edit Product</a></li>
    <li><a href="/a/product/delete">Delete Product</a></li>
    <li><a href="/a/product/add">Add Product</a></li>
</ul>
<ul>
    <li><a href="/a/bulletins">All Bulletins</a></li>
    <li><a href="/a/users">All Users</a></li>
    <li><a href="/a/settings">Settings</a></li>
    <li><a href="/a/logout">Logout</a></li>
</ul>
<hr>
@foreach($products as $product)
    Name: {{ $product->name }}
    <br>
    Description: {{ $product->description }}
    <br>
    Sale Price: {{ $product->sale_price }}
    <br>
    Wholesale Price: {{ $product->wholesale_price }}
    <br>
    Commission: {{ $product->commission }}&percnt;
    <br>
    image: <img src="{{Storage::url('products/' . $product->image_name)}}" height="100">
    <br>
    <a href="{{ route('product.edit', ['id' => $product->id]) }}">Edit Product</a>
    <a href="{{ route('product.delete', ['id' => $product->id]) }}">Delete Product</a>
    <hr>
@endforeach
</body>
</html>