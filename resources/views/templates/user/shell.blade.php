<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ezy2biz | User Panel</title>

    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('/favicon-96x96.png') }}">
    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('/sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{ URL::asset('/sb-admin/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('/sb-admin/css/sb-admin.css') }}" rel="stylesheet">

    <style>
        .sidebar {
            background-color: #2a3f54;
        }

        .sidebar .nav-item .nav-link {
            color: #eee;
        }

        .bg-dark {
            background-color: #253a4f !important;
        }
    </style>
    @yield('specific-css')

</head>

<body id="page-top">

@include('templates.user.top-bar')

@if(\Illuminate\Support\Facades\Session::has('e'))
    <div class="col-md-6 offset-md-3 mt-3" style="position: absolute; top: 0; height: 50px;">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ \Illuminate\Support\Facades\Session::get('e') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

@elseif(\Illuminate\Support\Facades\Session::has('s'))
    <div class="col-md-6 offset-md-3 mt-3" style="position: absolute; top: 10px;">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ \Illuminate\Support\Facades\Session::get('s') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

<div id="wrapper">
   <!-- Sidebar -->
    @include('templates.user.side-bar')

    <div id="content-wrapper">

    @yield('body')
    <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            @include('templates.footer')
        </footer>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ URL::asset('/sb-admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ URL::asset('/sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Page level plugin JavaScript-->
<script src="{{ URL::asset('/sb-admin/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ URL::asset('/sb-admin/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('/sb-admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ URL::asset('/sb-admin/js/sb-admin.min.js') }}"></script>

<!-- Demo scripts for this page-->
<script src="{{ URL::asset('/sb-admin/js/demo/datatables-demo.js') }}"></script>
<script src="{{ URL::asset('/sb-admin/js/demo/chart-area-demo.js') }}"></script>

</body>

</html>
