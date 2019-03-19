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
@foreach($orders as $order)
    <hr>
    Order ID: {{ $order->id }} <br>
    Buyer ID: {{ $order->buyer_id }} <br>
    Buyer Name: {{ $order->first_name }} {{ $order->last_name }} <br>
    Buyer Phone: {{ $order->phone }} <br>
    Buyer Address: {{ $order->address }} <br>
    Product ID: {{ $order->product_id }} <br>
    Product Name: {{ $order->name }} <br>
    Product Quantity: {{ $order->quantity }} <br>
    Product Sale Price: {{ $order->sale_price }} <br>
    Total Cost: {{ $order->total_cost }} <br>
    Order Status: {{ $order->order_status }} <br>

    <form action="/a/product-orders" method="post">
        @csrf
        <input type="hidden" name="order-id" value="{{ $order->id }}">
        <input type="hidden" name="response" value="complete">
        <input type="submit" name="submit" value="Complete Order">
    </form>

    <form action="/a/product-orders" method="post">
        @csrf
        <input type="hidden" name="order-id" value="{{ $order->id }}">
        <input type="hidden" name="response" value="reject">
        <input type="submit" name="submit" value="Reject Order">
    </form>
@endforeach
</body>
</html>