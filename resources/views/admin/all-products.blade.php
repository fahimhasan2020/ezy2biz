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
    @foreach($product->image_paths as $image)
        <br>
        {{ $image }}
        image: <img src="{{Storage::url('' . $image)}}" height="100">
        <br>
    @endforeach
    <a href="{{ route('product.single', ['id' => $product->id]) }}">Edit Product</a>
    <form action="{{ route('product.delete') }}" method="post">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="submit" name="submit" value="Delete Product">
    </form>
    <hr>
@endforeach
</body>
</html>