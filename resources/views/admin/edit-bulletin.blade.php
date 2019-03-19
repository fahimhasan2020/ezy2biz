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
<h1>This is Admin Edit Bulletin page</h1>
<hr>
<ul>
    <li><a href="/a/products">All Products</a></li>
    <li><a href="/a/users">All Users</a></li>
    <li><a href="/a/settings">Settings</a></li>
    <li><a href="/a/logout">Logout</a></li>
</ul>
<hr>
<form action="{{ route('admin.edit-bulletin', ['id' => $bulletin->id]) }}" method="post">
    @csrf
    @method('PUT')
    <label>
        Title:
        <input type="text" name="title" value="{{ $bulletin->title }}">
    </label>
    <br>
    <label>
        Description:
        <textarea name="description" cols="80" rows="20" placeholder="Write description...">{{ $bulletin->description }}</textarea>
    </label>
    <br>
    <label>
        <input type="submit" name="submit" value="Update Bulletin">
    </label>
</form>
</body>
</html>