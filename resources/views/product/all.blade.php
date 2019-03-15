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
<h1>This is All Products page</h1>
<hr>
<ul>
    <li><a href="/product/1">Single Product</a></li>
    <li><a href="/product/1/buy">Buy Product</a></li>
</ul>
<ul>
    <li><a href="/u/dashboard">Dashboard</a></li>
    <li><a href="/bulletins">Bulletins</a></li>
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
    <a href="{{ route('product.buy', ['id' => $product->id]) }}">Buy Product</a>
    <hr>
@endforeach
</body>
</html>