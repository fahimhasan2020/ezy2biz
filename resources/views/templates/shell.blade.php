<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ezy2biz</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('/favicon-96x96.png') }}">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ URL::asset('/vendors/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" integrity="sha384-DmABxgPhJN5jlTwituIyzIUk6oqyzf3+XuP7q3VfcWA2unxgim7OSSZKKf0KSsnh" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="{{ URL::asset('/vendor/font-awesome/css/font-awesome.min.css') }}">--}}
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- owl carousel-->
    <link rel="stylesheet" href="{{ URL::asset('/vendors/owl.carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/vendors/owl.carousel/assets/owl.theme.default.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ URL::asset('/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ URL::asset('/css/custom.css') }}">
    @yield('custom-css')

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
<!-- navbar-->
<header class="header">
    @include('templates.top-bar')
</header>

<div id="all">

    @if(\Illuminate\Support\Facades\Session::has('e'))
        <div class="col-md-6 offset-md-3 mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ \Illuminate\Support\Facades\Session::get('e') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        </div>

    @elseif(\Illuminate\Support\Facades\Session::has('s'))
        <div class="col-md-6 offset-md-3 mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ \Illuminate\Support\Facades\Session::get('s') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    @yield('body')
</div>

<!--
*** COPYRIGHT ***
_________________________________________________________
-->
<div id="copyright">
    @include('templates.footer')
</div>
<!-- *** COPYRIGHT END ***-->

<!-- JavaScript files-->
<script src="{{ URL::asset('/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('/vendors/jquery.cookie/jquery.cookie.js') }}"> </script>
<script src="{{ URL::asset('/vendors/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ URL::asset('/vendors/owl.carousel2.thumbs/owl.carousel2.thumbs.js') }}"></script>
<script src="{{ URL::asset('/js/front.js') }}"></script>
</body>
</html>