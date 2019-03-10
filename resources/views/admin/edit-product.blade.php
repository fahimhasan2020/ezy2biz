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
<h1>This is Admin Edit Product page</h1>
<hr>
<ul>
    <li><a href="/a/bulletins">All Bulletins</a></li>
    <li><a href="/a/users">All Users</a></li>
    <li><a href="/a/settings">Settings</a></li>
    <li><a href="/a/logout">Logout</a></li>
</ul>
<hr>
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>
        Product Name:
        <input type="text" name="name" value="{{ $product[0]->name }}">
    </label>
    <br>
    <label>
        Product Description:
        <input type="text" name="description" value="{{ $product[0]->description }}">
    </label>
    <br>
    <label>
        Sale Price:
        <input type="number" name="sale-price" value="{{ $product[0]->sale_price }}">
    </label>
    <br>
    <label>
        Wholesale Price:
        <input type="number" name="wholesale-price" value="{{ $product[0]->wholesale_price }}">
    </label>
    <br>
    <label>
        Commission: (In percentage)
        <input type="number" name="commission" value="{{ $product[0]->commission }}"> &percnt;
    </label>
    <br>
    <label>
        Product Image: <img alt="" src="{{Storage::url('products/' . $product[0]->image_name)}}" height="100">
        <input type="file" name="image">
    </label>
    <br>
    <label>
        <input type="submit" name="submit" value="Update Product">
    </label>
</form>
</body>
</html>