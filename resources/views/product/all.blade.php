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
                            <li aria-current="page" class="breadcrumb-item active">Products</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-lg-12">
                    <div class="box">
                        <h1>Our Products</h1>
                    </div>

                    <div class="row products">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6">
                                <div class="product">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="/product/{{ $product->id }}">
                                                    <img src="{{ Storage::url('' . current($product->image_paths)) }}" alt="" class="img-fluid" style="max-height: 250px;">
                                                </a>
                                            </div>
                                            <div class="back">
                                                <a href="/product/{{ $product->id }}">
                                                <img src="{{ Storage::url('' . current($product->image_paths)) }}" alt="" class="img-fluid" style="max-height: 250px;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="/product/{{ $product->id }}" class="invisible">
                                        <img src="{{ Storage::url('' . current($product->image_paths)) }}" alt="" class="img-fluid" style="max-height: 250px;">
                                    </a>
                                    <div class="text">
                                        <h3>
                                            <a href="/product/{{ $product->id }}">{{ $product->name }}
                                            </a>
                                        </h3>
                                        <p class="price">Price: {{ $product->sale_price }}</p>
                                        <p class="buttons">
                                            <a href="/product/{{ $product->id }}" class="btn btn-outline-secondary">
                                                View details
                                            </a>
                                            <a href="/u/buy/product/{{ $product->id }}" class="btn btn-primary">
                                                <i class="fa fa-shopping-cart"></i> Buy
                                            </a>
                                        </p>
                                    </div>
                                    <!-- /.text-->
                                </div>
                                <!-- /.product            -->
                            </div>
                        @endforeach
                        <!-- /.products-->
                    </div>
                    <div class="pages">
                        <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                            <ul class="pagination">
                                @if($prevPage)
                                    <li class="page-item">
                                        <a href="/products?page={{ $prevPage }}" aria-label="Previous" class="page-link">
                                            <span aria-hidden="true">«</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                                @for($i = 1; $i <= $totalPages; $i++)
                                    @if($i == $curPage)
                                        <li class="page-item active">
                                            <a href="#" class="page-link">{{ $i }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="/products?page={{ $i }}" class="page-link">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor
                                @if($nextPage)
                                    <li class="page-item">
                                        <a href="/products?page={{ $nextPage }}" aria-label="Next" class="page-link">
                                            <span aria-hidden="true">»</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /.col-lg-9-->
            </div>
        </div>
    </div>
@stop