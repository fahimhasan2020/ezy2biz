<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ezy2biz | Admin Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('/sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('/sb-admin/css/sb-admin.css') }}" rel="stylesheet">
</head>

<body class="bg-dark">

@if(\Illuminate\Support\Facades\Session::has('e'))
    <div class="col-md-6 offset-md-3 mt-3" style="position: absolute; top: 0; height: 50px; z-index: 10;">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ \Illuminate\Support\Facades\Session::get('e') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

@elseif(\Illuminate\Support\Facades\Session::has('s'))
    <div class="col-md-6 offset-md-3 mt-3" style="position: absolute; top: 10px;  z-index: 10;">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ \Illuminate\Support\Facades\Session::get('s') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form method="post" action="/a/login">
                @csrf
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
                        <label for="inputEmail">Email address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ URL::asset('/sb-admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ URL::asset('/sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

</body>

</html>
