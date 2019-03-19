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
<h1>This is User Tree page</h1>
<hr>
<ul>
    <li><a href="/u/dashboard">Dashboard</a></li>
    <li><a href="/products">Products</a></li>
    <li><a href="/bulletins">Bulletins</a></li>
</ul>
<hr>
Name: {{ $currentUser->first_name }} {{ $currentUser->last_name }} <br>
Email: {{ $currentUser->email }} <br>
Active: @if($currentUser->is_active) Yes @else No @endif <br>
ID: {{ $currentUser->id }} <br>
<hr>
<form action="{{ route('user.ref-link') }}" method="post">
    @csrf
    <labe>
        Parent:
        <input type="text" name="parent-id">
    </labe>
    <labe>
        <input type="submit" name="submit" value="Generate Referral Link">
    </labe>
</form>
</body>
</html>