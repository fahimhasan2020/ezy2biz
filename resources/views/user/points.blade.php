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
<h1>This is User Balance page</h1>
<hr>
<ul>
    <li><a href="/u/account?action=transfer">Point Transfer</a></li>
    <li><a href="/u/account?action=request">Point Request</a></li>
    <li><a href="/u/account?action=withdraw">Withdrawal Request</a></li>
</ul>
<ul>
    <li><a href="/u/dashboard">Dashboard</a></li>
    <li><a href="/products">Products</a></li>
    <li><a href="/bulletins">Bulletins</a></li>
</ul>
<hr>
User: {{ $user->first_name }} {{ $user->last_name }}
Active: @if($user->is_active) Yes @else No @endif
Points: {{ $user->points }}
<hr>
@if ($action === 'transfer')
    <form action="/u/account/transfer" method="post">
        @csrf
        <label>
            Send To:
            <input type="text" name="recipient">
        </label>
        <label>
            Amount:
            <input type="number" name="amount">
        </label>
        <label>
            <input type="submit" name="submit" value="Send">
        </label>
    </form>

@elseif($action === 'request')
    <form action="/u/account/req" method="post">
        @csrf
        <label>
            bKash Number:
            <input type="text" name="bkash-num">
        </label>
        <label>
            Amount:
            <input type="number" name="amount">
        </label>
        <label>
            <input type="submit" name="submit" value="Request Points">
        </label>
    </form>

@elseif($action === 'withdraw')
    <form action="/u/account/withdraw" method="post">
        @csrf
        <label>
            bKash Number:
            <input type="text" name="bkash-num">
        </label>
        <label>
            Amount (Points):
            <input type="number" name="amount">
        </label>
        <label>
            <input type="submit" name="submit" value="Request Withdrawal">
        </label>
    </form>
@endif
</body>
</html>