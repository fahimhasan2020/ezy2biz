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
<h1>This is Admin Single Product page</h1>
<hr>
<ul>
    <li><a href="/a/product/1/edit">Edit Product</a></li>
    <li><a href="/a/product/delete">Delete Product</a></li>
</ul>
<ul>
    <li><a href="/a/bulletins">All Products</a></li>
    <li><a href="/a/users">All Users</a></li>
    <li><a href="/a/settings">Settings</a></li>
    <li><a href="/a/logout">Logout</a></li>
</ul>
</body>
</html>