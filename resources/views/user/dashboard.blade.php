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
    <h1>This is User Dashboard</h1>
    <hr>
    <ul>
        <li><a href="/u/tree">Tree</a></li>
        <li><a href="/u/account">Account</a></li>
        <li><a href="/u/settings">Settings</a></li>
        <li><a href="/u/ref-link">Referral Link</a></li>
        <li><a href="/u/logout">Logout</a></li>
    </ul>
    <ul>
        <li><a href="/products">Products</a></li>
        <li><a href="/bulletins">Bulletins</a></li>
    </ul>
</body>
</html>