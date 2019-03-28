@extends('templates.user.shell')

@section('specific-css')
    <style>
        .rounded-list ol
        {
            counter-reset:li; /* Initiate a counter */
            margin-left:0; /* Remove the default left margin */
            padding-left:0; /* Remove the default left padding */
        }

        /* item  */
        .rounded-list ol > li
        {
            position:relative; /* Create a positioning context */
            list-style:none; /* Disable the normal item numbering */
            background:#f6f6f6; /* Item background color */
            margin:0; /* Give each list item a left margin to make room for the numbers */
            padding-left: 15px; /* Add some spacing around the content */
            padding-bottom:0px;
            padding-top:0px;
        }

        /* number  */
        .rounded-list ol > li p:before
        {
            content: counter(li);
            counter-increment: li;
            position: absolute;
            left: -1.3em;
            top: 50%;

            /* number background */
            background: #87ceeb;
            height: 2em;
            width: 2em;
            margin-top: -1em;
            line-height: 1.5em;
            border: .3em solid #fff;
            text-align: center;
            font-weight: bold;
            border-radius: 2em;
        }
    </style>
@stop

@section('body')
    <div class="container-fluid mb-5">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Buy Product</li>
        </ol>

        <!-- Page Content -->
        <h1>Buy Product</h1>
        <hr>

        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="profile-head">
                        <h5>
                            {{ $user->first_name }} {{ $user->last_name }}
                        </h5>
                        <p class="profile-rating">
                            STEP : <span>{{ $user->step }}</span>
                            <br>
                            POINTS : <span>{{ $user->points }}</span>
                        </p>
                    </div>
                    <hr>
                    <div>
                        <form action="/u/buy/product/{{ $product->id }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="qty">Product Quantity</label>
                                <input id="qty" name="qty" type="number" class="form-control" value="1" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Enter password to proceed</label>
                                <input id="password" name="password" type="password" class="form-control" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart"></i> Buy
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-md-5">
                    <div class="container">
                        <div class="col-md-12 mb-5">
                            <div class="card text-center">
                                <div class="card-header">
                                    You are buying this product
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">
                                        Price: {{ $product->sale_price }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card text-center">
                                <div class="card-header">
                                    How to pay for the product?
                                </div>
                                <div class="card-body text-left">
                                    <h4 class="mb-3">Send money via bKash</h4>
                                    <table border="0" class="rounded-list ml-3 mr-3">
                                        <tr>
                                            <td>
                                                <ol>
                                                    <li><p>Step 1</p></li>
                                                    <li><p>Step 2</p></li>
                                                    <li><p>Step 3</p></li>
                                                    <li><p>Step 4</p></li>
                                                    <li><p>Step 5</p></li>
                                                </ol>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop