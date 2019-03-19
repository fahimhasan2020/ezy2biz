<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ezy2biz</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ URL::asset('/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ URL::asset('/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- owl carousel-->
    <link rel="stylesheet" href="{{ URL::asset('/vendor/owl.carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/vendor/owl.carousel/assets/owl.theme.default.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ URL::asset('/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ URL::asset('/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
<!-- navbar-->
<header class="header mb-5">
    @include('templates.top-bar')
</header>

<div id="all">
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
<script src="{{ URL::asset('/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
<script src="{{ URL::asset('/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ URL::asset('/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js') }}"></script>
<script src="{{ URL::asset('/js/front.js') }}"></script>
</body>
</html>