@extends('templates.admin.shell')

@section('body')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Product Orders</li>
        </ol>

        <!-- Page Content -->
        <h1>All Orders</h1>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Buyer Name</th>
                            <th scope="col">Contact Info</th>
                            <th scope="col">Address</th>
                            <th scope="col">Product Name</th>
                            <th scope="col" class="text-right">Sale Price</th>
                            <th scope="col" class="text-right">Quantity</th>
                            <th scope="col" class="text-right">Total</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->product_name }}</td>
                                <td class="text-right">{{ $order->sale_price }}</td>
                                <td class="text-right">{{ $order->quantity }}</td>
                                <td class="text-right">{{ $order->total_cost }}</td>
                                <td class="text-center">
                                    <form class="d-inline" action="/a/product-orders" method="post">
                                        @csrf
                                        <input type="hidden" name="order-id" value="{{ $order->id }}">
                                        <input type="hidden" name="response" value="complete">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check" title="Complete"></i>
                                        </button>
                                    </form>
                                    <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#productOrder{{$order->id}}">
                                        <i class="fas fa-times" title="Reject"></i>
                                    </a>
                                </td>
                            </tr>

                            <div class="modal fade" id="productOrder{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="order{{ $order->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="order{{ $order->id }}">Confirmation</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Do you really want to reject the order? Select "Yes" below if you want to proceed and remove the order. Remember, this action is irreversible.</div>
                                        <div class="modal-footer">
                                            <form class="d-inline" action="/a/product-orders" method="post">
                                                @csrf
                                                <input type="hidden" name="order-id" value="{{ $order->id }}">
                                                <input type="hidden" name="response" value="reject">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                                                <button class="btn btn-danger">Yes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


{{--@foreach($orders as $order)
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
@endforeach--}}