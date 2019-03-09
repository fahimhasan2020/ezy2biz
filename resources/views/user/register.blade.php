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
<h1>This is User Registration page</h1>
<hr>
<form action="{{route('user.register')}}" method="post">
    @csrf
    <label>
        First Name:
        <input type="text" name="first-name">
    </label>
    <br>
    <label>
        Last Name:
        <input type="text" name="last-name">
    </label>
    <br>
    <label>
        Phone No.:
        <input type="text" name="phone">
    </label>
    <br>
    <label>
        Address:
        <input type="text" name="address">
    </label>
    <br>
    <label>
        Parent:
        <input type="text" name="parent-id" >
    </label>
    <br>
    <label>
        Referrer:
        <input type="text" name="referrer-id" >
    </label>
    <br>
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
        Confirm Password:
        <input type="password" name="confirm-password">
    </label>
    <br>
    <label>
        <input type="submit" name="submit" value="Register">
    </label>
</form>
</body>
</html>