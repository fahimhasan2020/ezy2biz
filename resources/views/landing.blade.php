<?php $homeClass = 'active'; $productClass = ''; $bulletinClass = ''; ?>
@extends('templates.shell')

@section('body')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="main-slider" class="owl-carousel owl-theme">
                        <div class="item">
                            <img src="{{ URL::asset('/img/main-slider1.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="{{ URL::asset('/img/main-slider2.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="{{ URL::asset('/img/main-slider3.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="{{ URL::asset('/img/main-slider4.jpg') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <!-- /#main-slider-->
                </div>
            </div>
        </div>
        <!--
        *** ADVANTAGES HOMEPAGE ***
        _________________________________________________________
        -->
        <div id="advantages">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                            <div class="icon"><i class="fa fa-heart"></i></div>
                            <h3><a href="#">Top Bulletin 1</a></h3>
                            <p class="mb-0">We are known to provide best possible service ever</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                            <div class="icon"><i class="fa fa-tags"></i></div>
                            <h3><a href="#">Top Bulletin 2</a></h3>
                            <p class="mb-0">You can check that the height of the boxes adjust when longer text like this one is used in one of them.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                            <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                            <h3><a href="#">Top Bulletin 3</a></h3>
                            <p class="mb-0">Free returns on everything for 3 months.</p>
                        </div>
                    </div>
                </div>
                <!-- /.row-->
            </div>
            <!-- /.container-->
        </div>
        <!-- /#advantages-->
        <!-- *** ADVANTAGES END ***-->
        <!--
        *** HOT PRODUCT SLIDESHOW ***
        _________________________________________________________
        -->
        <div id="hot">
            <div class="box py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="mb-0">Top this week</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="product-slider owl-carousel owl-theme">
                    <div class="item">
                        <div class="product">
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product1.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product1_2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="detail.html" class="invisible">
                                <img src="{{ URL::asset('img/product1.jpg') }}" alt="" class="img-fluid">
                            </a>
                            <div class="text">
                                <h3><a href="detail.html">some text</a></h3>
                                <p class="price">ID:01</p>
                            </div>

                        </div>
                        <!-- /.product-->
                    </div>
                    <div class="item">
                        <div class="product">
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product2_2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="detail.html" class="invisible">
                                <img src="{{ URL::asset('img/product2.jpg') }}" alt="" class="img-fluid">
                            </a>
                            <div class="text">
                                <h3><a href="detail.html">text</a></h3>
                                <p class="price">ID:02</p>
                            </div>

                        </div>
                        <!-- /.product-->
                    </div>
                    <div class="item">
                        <div class="product">
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product3.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product3_2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="detail.html" class="invisible">
                                <img src="{{ URL::asset('img/product3.jpg') }}" alt="" class="img-fluid">
                            </a>
                            <div class="text">
                                <h3><a href="detail.html">something</a></h3>
                                <p class="price">
                                    ID:03
                                </p>
                            </div>
                            <!-- /.text-->
                        </div>
                        <!-- /.product-->
                    </div>
                    <div class="item">
                        <div class="product">
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product3.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product3_2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="detail.html" class="invisible">
                                <img src="{{ URL::asset('img/product3.jpg') }}" alt="" class="img-fluid">
                            </a>
                            <div class="text">
                                <h3><a href="detail.html">something</a></h3>
                                <p class="price">
                                    ID:03
                                </p>
                            </div>
                            <!-- /.text-->
                        </div>
                        <!-- /.product-->
                    </div>
                    <div class="item">
                        <div class="product">
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product2_2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="detail.html" class="invisible">
                                <img src="{{ URL::asset('img/product2.jpg') }}" alt="" class="img-fluid">
                            </a>
                            <div class="text">
                                <h3><a href="detail.html">text</a></h3>
                                <p class="price">ID:02</p>
                            </div>

                        </div>
                        <!-- /.product-->
                    </div>
                    <div class="item">
                        <div class="product">
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product1.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product1_2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="detail.html" class="invisible">
                                <img src="{{ URL::asset('img/product1.jpg') }}" alt="" class="img-fluid">
                            </a>
                            <div class="text">
                                <h3><a href="detail.html">some text</a></h3>
                                <p class="price">ID:01</p>
                            </div>

                        </div>
                        <!-- /.product-->
                    </div>
                    <div class="item">
                        <div class="product">
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product2_2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="detail.html" class="invisible">
                                <img src="{{ URL::asset('img/product2.jpg') }}" alt="" class="img-fluid">
                            </a>
                            <div class="text">
                                <h3><a href="detail.html">text</a></h3>
                                <p class="price">ID:02</p>
                            </div>

                        </div>
                        <!-- /.product-->
                    </div>
                    <div class="item">
                        <div class="product">
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product3.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="detail.html">
                                            <img src="{{ URL::asset('img/product3_2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="detail.html" class="invisible">
                                <img src="{{ URL::asset('img/product3.jpg') }}" alt="" class="img-fluid">
                            </a>
                            <div class="text">
                                <h3><a href="detail.html">something</a></h3>
                                <p class="price">
                                    ID:03
                                </p>
                            </div>
                            <!-- /.text-->
                        </div>
                        <!-- /.product-->
                    </div>
                    <!-- /.product-slider-->
                </div>
                <!-- /.container-->
            </div>
            <!-- /#hot-->
            <!-- *** HOT END ***-->
        </div>
    </div>
@stop