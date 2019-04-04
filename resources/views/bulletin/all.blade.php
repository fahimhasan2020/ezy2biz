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
                            <li aria-current="page" class="breadcrumb-item active">Bulletin listing</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <!--
                *** LEFT COLUMN ***
                _________________________________________________________
                -->
                <div id="blog-listing" class="col-lg-9">
                    @foreach($bulletins as $bulletin)
                        <div class="post">
                            <h2>
                                <a href="/bulletin/{{ $bulletin->id }}">{{ $bulletin->title }}</a>
                            </h2>
                            <p class="author-category">
                                By <a href="#">{{ $bulletin->first_name }} {{ $bulletin->last_name }}</a>
                            </p>
                            <hr>
                            <p class="date-comments">
                                <a href="/bulletin/{{ $bulletin->id }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ date('D, F j, Y', strtotime($bulletin->publish_date)) }}
                                </a>
                            </p>
                            <p class="intro">
                                {{ \Illuminate\Support\Str::words($bulletin->description, 100) }}
                            </p>
                            <p class="read-more">
                                <a href="/bulletin/{{ $bulletin->id }}" class="btn btn-primary">Continue reading</a>
                            </p>
                        </div>
                    @endforeach

                    <div class="pager d-flex justify-content-between">
                        @if($prevPage)
                            <div class="previous">
                                <a href="/bulletins?page={{ $prevPage }}" class="btn btn-outline-primary">
                                    ← Older
                                </a>
                            </div>
                        @else
                            <div class="previous">
                                <a href="#" class="btn btn-outline-primary disabled">
                                    ← Older
                                </a>
                            </div>
                        @endif
                        @if($nextPage)
                            <div class="next">
                                <a href="/bulletins?page={{ $nextPage }}" class="btn btn-outline-secondary">
                                    Newer →
                                </a>
                            </div>
                        @else
                            <div class="next">
                                <a href="#" class="btn btn-outline-secondary disabled">
                                    Newer →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop