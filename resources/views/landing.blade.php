<?php $homeClass = 'active'; $productClass = ''; $bulletinClass = ''; ?>
@extends('templates.shell')

@section('custom-css')

<link rel="stylesheet" href="{{ URL::asset('/css/bulletin-ticker.css') }}">
@stop

@section('bulletin-ticker')
<div class="onoffswitch3">
    <input type="checkbox" name="onoffswitch3" class="onoffswitch3-checkbox" id="myonoffswitch3" checked>
    <label class="onoffswitch3-label" for="myonoffswitch3">
        <span class="onoffswitch3-inner">
            <span class="onoffswitch3-active">
                <marquee class="scroll-text" loop="true" onmouseover="this.stop();" onmouseout="this.start();">
                    @foreach($bulletins as $bulletin)
                    <i class="fas fa-forward"></i>
                    <a href="/bulletin/{{ $bulletin->id }}">{{ $bulletin->title }}</a>
                    @endforeach
                </marquee>
                <span class="onoffswitch3-switch">BULLETINS</span>
            </span>
            <span class="onoffswitch3-inactive"><span class="onoffswitch3-switch">SHOW BULLETINS</span></span>
        </span>
    </label>
</div>
@stop

@section('body')

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 banner text-center ">

                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100" style="padding:0;">

                    <img src="{{ URL::asset('/img/banner_top.jpg') }}" alt="ezy2biz banner" style="width: 100%">
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div id="main-slider" class="owl-carousel owl-theme">
                    @foreach($slides as $slide)
                        <div class="item">
                            <img src="{{ Storage::url($slide->image_path) }}" alt="" class="img-fluid" style="max-height: 90vh;">
                        </div>
                    @endforeach
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
                    <div class="item"><img src="{{ URL::asset('img/Michael Dell.jpg') }}" alt="Picture of Micharel Dell"
                            class="img-fluid"></div>
                    <h3><a href="#">Michael Dell</a></h3>
                    <p class="mb-0">We are known to provide best possible service ever</p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                    <h3><a href="#">About Michael Dell</a></h3>
                    <p class="mb-0">Michael Dell, founder and chief executive officer of Dell Inc.
                        The latest Forbes rankings show three of the world's five richest people earned their fortunes
                        in tech, and 59 percent of the world's tech billionaires got richer over the past year.
                        The 183 billionaires from tech - 23 more than a year ago - have a combined net worth of $1
                        trillion.
                        Michael Dell as the richest person in the world, Microsoft co-founder Bill Gates not
                        surprisingly tops the list of wealthiest tech billionaires with a net worth of $86 billion. He's
                        followed by Amazon CEO Jeff Bezos ($72.8 billion) and Facebook CEO Mark Zuckerberg ($56
                        billion).
                        Here's the full list of the top 10 tech billionaires in the world.

                        No 10 Michael Dell ( Net worth: $20.4 billion)</p>
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
            @foreach($users as $user)
            <div class="item">
                <div class="product">
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front">
                                <a href="#">
                                    <img src="{{ Storage::url('' . $user->photo) }}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="back">
                                <a href="#">
                                    <img src="{{ Storage::url('' . $user->photo) }}" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="invisible">
                        <img src="{{ Storage::url('' . $user->photo) }}" alt="" class="img-fluid">
                    </a>
                    <div class="text">
                        <h3><a href="#">{{ $user->first_name }} {{ $user->last_name }}</a></h3>
                        <p class="price">
                            STEP: {{ $user->step }}
                            <br>
                            POINTS: {{ $user->points }}
                        </p>
                    </div>

                </div>
                <!-- /.product-->
            </div>
            @endforeach
        </div>
            <!-- /.product-slider-->
    </div>
        <!-- /.container-->
</div>
    <!-- /#hot-->
    <!-- *** HOT END ***-->
</div>
@stop