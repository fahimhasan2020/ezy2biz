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
<h1>This is Admin Add Product page</h1>
<hr>
<ul>
    <li><a href="/a/bulletins">All Bulletins</a></li>
    <li><a href="/a/users">All Users</a></li>
    <li><a href="/a/settings">Settings</a></li>
    <li><a href="/a/logout">Logout</a></li>
</ul>
<hr>
<form action="{{ route('product.add') }}" method="post" enctype="multipart/form-data">
    @csrf
    <label>
        Product Name:
        <input type="text" name="name">
    </label>
    <br>
    <label>
        Product Description:
        <input type="text" name="description">
    </label>
    <br>
    <label>
        Sale Price:
        <input type="number" name="sale-price">
    </label>
    <br>
    <label>
        Wholesale Price:
        <input type="number" name="wholesale-price">
    </label>
    <br>
    <label>
        Commission: (In percentage)
        <input type="number" name="commission"> &percnt;
    </label>
    <br>
    <label>
        Product Image:
        <input type="file" name="image">
    </label>
    <br>
    <label>
        <input type="submit" name="submit" value="Add Product">
    </label>
</form>
</body>
</html>