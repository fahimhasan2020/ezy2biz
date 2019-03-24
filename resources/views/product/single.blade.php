<?php $homeClass = ''; $productClass = 'active'; $bulletinClass = '' ?>
@extends('templates.shell')

@section('body')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- breadcrumb-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-3">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/products">Products</a></li>
                            <li aria-current="page" class="breadcrumb-item active">{{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-lg-12 order-1 order-lg-2">
                    <div id="productMain" class="row">
                        <div class="col-md-6">
                            <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                                @foreach($product->image_paths as $image)
                                    <div class="item"> <img src="{{ Storage::url($image) }}" alt="" class="img-fluid"></div>
                                @endforeach
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="box">
                                <h1 class="text-center">{{ $product->name }}</h1>
                                <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details</a></p>
                                <p class="price">Price: {{ $product->sale_price }}</p>
                                <p class="text-center buttons">
                                    <a href="/u/buy/product/{{ $product->id }}" class="btn btn-primary">
                                        <i class="fa fa-shopping-cart"></i> Buy
                                    </a>
                                </p>
                            </div>
                            <div data-slider-id="1" class="owl-thumbs">
                                @foreach($product->image_paths as $image)
                                    <button class="owl-thumb-item">
                                        <img src="{{ Storage::url($image) }}" alt="" class="img-fluid">
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div id="details" class="box">
                        <p></p>
                        <h4>Product details</h4>
                        <p>{{ $product->description }}</p>
                        <hr>
                    </div>
                </div>
                <!-- /.col-md-9-->
            </div>
        </div>
    </div>
@stop