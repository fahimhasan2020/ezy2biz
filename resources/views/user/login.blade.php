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
<h1>This is User Login page</h1>
<hr>
<ul>
    <li><a href="/u/dashboard">Dashboard</a></li>
</ul>
<hr>
<form action="{{ route('user.login') }}" method="post">
    @csrf
    <label>
        Email:
        <input type="email" name="email">
    </label>
    <br>
    <label>
        Password:
        <input type="password" name="password">
    </label>
    <br>
    <label>
        <input type="submit" name="submit" value="Login">
    </label>
</form>
</body>
</html>