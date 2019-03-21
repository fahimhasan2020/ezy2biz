<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ezy2biz | Admin Panel</title>

    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('/favicon-96x96.png') }}">
    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('/sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{ URL::asset('/sb-admin/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('/sb-admin/css/sb-admin.css') }}" rel="stylesheet">
    @yield('specific-css')

</head>

<body id="page-top">

@include('templates.admin.top-bar')

<div id="wrapper">

    <!-- Sidebar -->
    @include('templates.admin.side-bar')

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

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="/a/logout">Logout</a>
            </div>
        </div>
    </div>
</div>

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
