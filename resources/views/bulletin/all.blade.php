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
<h1>This is All Bulletins page</h1>
<hr>
<ul>
    <li><a href="/u/dashboard">Dashboard</a></li>
    <li><a href="/products">Products</a></li>
</ul>
@foreach($bulletins as $bulletin)
    <hr>
    <h3>{{ $bulletin->title }}</h3>
    <ul>
        <li>{{ $bulletin->first_name }} {{$bulletin->last_name}}</li>
        <li>{{ date('D, j F Y', strtotime($bulletin->publish_date)) }}</li>
    </ul>
    <p>{{ \Illuminate\Support\Str::words($bulletin->description, 100) }}
        <a href="/bulletin/{{ $bulletin->id }}">Read more</a>
    </p>
@endforeach
</body>
</html>