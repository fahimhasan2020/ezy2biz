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
<h1>This is Product Buy page</h1>
<hr>
<ul>
    <li><a href="/u/dashboard">Dashboard</a></li>
    <li><a href="/bulletins">Bulletins</a></li>
</ul>
<hr>
User name: {{ $user->first_name }} {{ $user->last_name }}
Points: {{ $user->points }}
Is active: @if($user->is_active) Yes @else No @endif
<hr>
Product name: {{ $product->name }}
Product description: {{ $product->description }}
Product price: {{ $product->sale_price }}
Product images:
@foreach($product->image_paths as $image)
    <img alt="" src="{{Storage::url('' . $image)}}" height="100">
@endforeach

<form action="{{ url()->current() }}" method="post">
    @csrf
    <label>
        Enter password to proceed:
        <input type="password" name="password">
        <input type="submit" name="submit" value="Proceed">
    </label>
</form>
</body>
</html>