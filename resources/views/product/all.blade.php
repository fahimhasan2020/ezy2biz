{!! $homeClass = ''; $productClass = 'active'; $bulletinClass = '' !!}
@extends('templates.shell')

@section('body')
    {{--@foreach($products as $product)
        Name: {{ $product->name }}
        <br>
        Description: {{ $product->description }}
        <br>
        Sale Price: {{ $product->sale_price }}
        <br>
        Wholesale Price: {{ $product->wholesale_price }}
        <br>
        Commission: {{ $product->commission }}&percnt;
        <br>
        @foreach($product->image_paths as $image)
            <br>
            {{ $image }}
            image: <img src="{{Storage::url('' . $image)}}" height="100">
            <br>
        @endforeach
        <a href="{{ route('product.buy', ['id' => $product->id]) }}">Buy Product</a>
        <hr>
    @endforeach--}}

    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- breadcrumb-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li aria-current="page" class="breadcrumb-item active">Ladies</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <!--
                    *** MENUS AND FILTERS ***
                    _________________________________________________________
                    -->
                    <div class="card sidebar-menu mb-4">
                        <div class="card-header">
                            <h3 class="h4 card-title">Categories</h3>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column category-menu">
                                <li><a href="category.html" class="nav-link">Men <span class="badge badge-secondary">42</span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="category.html" class="nav-link">T-shirts</a></li>
                                        <li><a href="category.html" class="nav-link">Shirts</a></li>
                                        <li><a href="category.html" class="nav-link">Pants</a></li>
                                        <li><a href="category.html" class="nav-link">Accessories</a></li>
                                    </ul>
                                </li>
                                <li><a href="category.html" class="nav-link active">Ladies  <span class="badge badge-light">123</span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="category.html" class="nav-link">T-shirts</a></li>
                                        <li><a href="category.html" class="nav-link">Skirts</a></li>
                                        <li><a href="category.html" class="nav-link">Pants</a></li>
                                        <li><a href="category.html" class="nav-link">Accessories</a></li>
                                    </ul>
                                </li>
                                <li><a href="category.html" class="nav-link">Kids  <span class="badge badge-secondary">11</span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="category.html" class="nav-link">T-shirts</a></li>
                                        <li><a href="category.html" class="nav-link">Skirts</a></li>
                                        <li><a href="category.html" class="nav-link">Pants</a></li>
                                        <li><a href="category.html" class="nav-link">Accessories</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <!-- *** MENUS AND FILTERS END ***-->

                </div>
                <div class="col-lg-9">
                    <div class="box">
                        <h1>Ladies</h1>
                        <p>In our Ladies department we offer wide selection of the best products we have found and carefully selected worldwide.</p>
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
                        <div class="col-lg-4 col-md-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product1.jpg" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product1_2.jpg" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product1.jpg" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3><a href="detail.html">Fur coat with very but very very long name</a></h3>
                                    <p class="price">
                                        200tk
                                    </p>
                                    <p class="buttons"><a href="detail.html" class="btn btn-outline-secondary">View detail</a><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>
                                </div>
                                <!-- /.text-->
                            </div>
                            <!-- /.product            -->
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product2.jpg" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product2_2.jpg" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product2.jpg" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3><a href="detail.html">White Blouse Armani</a></h3>
                                    <p class="price">
                                        $143.00(discount 5%)
                                    </p>
                                    <p class="buttons"><a href="detail.html" class="btn btn-outline-secondary">View detail</a><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>
                                </div>
                                <!-- /.text-->

                            </div>
                            <!-- /.product            -->
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product3.jpg" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product3_2.jpg" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product3.jpg" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3><a href="detail.html">Black Blouse Versace</a></h3>
                                    <p class="price">
                                        <del></del>$143.00
                                    </p>
                                    <p class="buttons"><a href="detail.html" class="btn btn-outline-secondary">View detail</a><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>
                                </div>
                                <!-- /.text-->
                            </div>
                            <!-- /.product            -->
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product3.jpg" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product3_2.jpg" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product3.jpg" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3><a href="detail.html">Black Blouse Versace</a></h3>
                                    <p class="price">
                                        <del></del>$143.00
                                    </p>
                                    <p class="buttons"><a href="detail.html" class="btn btn-outline-secondary">View detail</a><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>
                                </div>
                                <!-- /.text-->
                            </div>
                            <!-- /.product            -->
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product2.jpg" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product2_2.jpg" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product2.jpg" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3><a href="detail.html">White Blouse Versace</a></h3>
                                    <p class="price">
                                        <del></del>$143.00
                                    </p>
                                    <p class="buttons"><a href="detail.html" class="btn btn-outline-secondary">View detail</a><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>
                                </div>
                                <!-- /.text-->

                            </div>
                            <!-- /.product            -->
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product1.jpg" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product1_2.jpg" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product1.jpg" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3><a href="detail.html">Fur coat</a></h3>
                                    <p class="price">
                                        <del></del>$143.00
                                    </p>
                                    <p class="buttons"><a href="detail.html" class="btn btn-outline-secondary">View detail</a><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>
                                </div>
                                <!-- /.text-->

                            </div>
                            <!-- /.product            -->
                        </div>
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