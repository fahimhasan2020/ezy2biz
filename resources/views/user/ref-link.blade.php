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
<h1>This is User Referral Link page</h1>
<hr>
<ul>
    <li><a href="/u/dashboard">Dashboard</a></li>
    <li><a href="/u/tree">Referral Tree</a></li>
    <li><a href="/products">Products</a></li>
    <li><a href="/bulletins">Bulletins</a></li>
</ul>
<hr>
@foreach($refLinks as $refLink)
<ul>
    <li>{{ url("/u/register/referral={$refLink->referral_key}") }}</li>
    <li>{{ $refLink->parent_fn }} {{ $refLink->parent_ln }}</li>
    <li>{{ $refLink->parent_email }}</li>
    <li>{{ ucfirst($refLink->status) }}</li>
</ul>
@endforeach
</body>
</html>