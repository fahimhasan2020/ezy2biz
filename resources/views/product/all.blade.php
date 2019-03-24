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
                    <div class="box info-bar">
                        <div class="row">
                            <div class="col-md-12 col-lg-4 products-showing">Showing <strong>12</strong> of <strong>25</strong> products</div>
                            <div class="col-md-12 col-lg-7 products-number-sort">
                                <form class="form-inline d-block d-lg-flex justify-content-between flex-column flex-md-row">
                                    <div class="products-number"><strong>Show</strong><a href="#" class="btn btn-sm btn-primary">12</a><a href="#" class="btn btn-outline-secondary btn-sm">24</a><a href="#" class="btn btn-outline-secondary btn-sm">All</a><span>products</span></div>
                                    <div class="products-sort-by mt-2 mt-lg-0"><strong>Sort by</strong>
                                        <select name="sort-by" class="form-control">
                                            <option>Price</option>
                                            <option>Name</option>

                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row products">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6">
                                <div class="product">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="/product/{{ $product->id }}">
                                                    <img src="{{ Storage::url('' . $product->image_paths[0]) }}" alt="" class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="back">
                                                <a href="/product/{{ $product->id }}">
                                                <img src="{{ Storage::url('' . $product->image_paths[0]) }}" alt="" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="/product/{{ $product->id }}" class="invisible">
                                        <img src="{{ Storage::url('' . $product->image_paths[0]) }}" alt="" class="img-fluid">
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
                        <p class="loadMore"><a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a></p>
                        <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                            <ul class="pagination">
                                <li class="page-item"><a href="#" aria-label="Previous" class="page-link"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                                <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">4</a></li>
                                <li class="page-item"><a href="#" class="page-link">5</a></li>
                                <li class="page-item"><a href="#" aria-label="Next" class="page-link"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /.col-lg-9-->
            </div>
        </div>
    </div>
@stop