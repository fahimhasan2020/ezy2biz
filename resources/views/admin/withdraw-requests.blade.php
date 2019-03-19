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
<h1>This is Admin Dashboard page</h1>
<hr>
<ul>
    <li><a href="/a/products">All Products</a></li>
    <li><a href="/a/bulletins">All Bulletins</a></li>
    <li><a href="/a/users">All Users</a></li>
    <li><a href="/a/settings">Settings</a></li>
    <li><a href="/a/logout">Logout</a></li>
</ul>
<hr>
@foreach($requests as $request)
    Applicant Name: {{ $request->first_name }} {{ $request->last_name }} <br>
    Email: {{ $request->email }} <br>
    Phone: {{ $request->phone }} <br>
    Sent Amount: {{ $request->amount }} <br>
    bKash Number: {{ $request->bkash_no }} <br>
    Requested time: {{ $request->timestamp }} <br>

    <form action="/a/withdraw-requests" method="post">
        @csrf
        <input type="hidden" name="request-id" value="{{ $request->id }}">
        <input type="hidden" name="applicant-id" value="{{ $request->applicant_id }}">
        <input type="hidden" name="response" value="accept">
        <label>
            Points to be withdrawn:
            <input type="number" name="points" value="{{ $request->amount }}">
        </label>
        <input type="submit" name="submit" value="Accept">
    </form>
    <form action="/a/withdraw-requests" method="post">
        @csrf
        <input type="hidden" name="request-id" value="{{ $request->id }}">
        <input type="hidden" name="response" value="reject">
        <input type="submit" name="submit" value="Reject">
    </form>
@endforeach
</body>
</html>