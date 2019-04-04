<?php $homeClass = ''; $productClass = ''; $bulletinClass = 'active' ?>
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
                            <li class="breadcrumb-item"><a href="/bulletins">Bulletins</a></li>
                            <li aria-current="page" class="breadcrumb-item active">{{ $bulletin->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div id="blog-listing" class="col-lg-9">
                    <div class="post">
                        <h1>{{ $bulletin->title }}</h1>
                        <p class="author-date">
                            By <a href="#">{{ $bulletin->first_name }} {{ $bulletin->last_name }}</a> |
                            {{ date('D, F j, Y', strtotime($bulletin->publish_date)) }}
                        </p>
                        <div id="post-content">
                            {{ $bulletin->description }}
                        </div>
                        <!-- /#post-content-->

                    </div>
                    <!-- /.box-->
                </div>
            </div>
        </div>
    </div>
@stop