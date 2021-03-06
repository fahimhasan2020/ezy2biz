<div id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offer mb-3 mb-lg-0"></div>
            <div class="col-lg-6 text-center text-lg-right">
                <ul class="menu list-inline mb-0">
                    @if(\Illuminate\Support\Facades\Session::has('user'))
                        <li class="list-inline-item"><a href="/u/account">Dashboard</a></li>
                        <li class="list-inline-item"><a href="/u/logout">Logout</a></li>
                    @elseif(\Illuminate\Support\Facades\Session::has('admin'))
                        <li class="list-inline-item"><a href="/a/dashboard">Dashboard</a></li>
                        <li class="list-inline-item"><a href="/a/logout">Logout</a></li>
                    @else
                        <li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                        <li class="list-inline-item"><a href="/register">Register</a></li>
                    @endif
                    <li class="list-inline-item"><a href="#">Policy</a></li>
                    <li class="list-inline-item"><a href="#">FAQ</a></li>

                </ul>
            </div>
        </div>
    </div>
    <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User login</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="/u/login" method="post">
                        @csrf
                        <div class="form-group">
                            <input id="email-modal" name="email" type="text" placeholder="Enter email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input id="password-modal" name="password" type="password" placeholder="Enter password" class="form-control" required>
                        </div>
                        <p class="text-center">
                            <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                        </p>
                    </form>
                    <p class="text-center text-muted">Not registered yet?</p>
                    <p class="text-center text-muted">
                        <a href="/register">
                            <strong>Register now</strong>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- *** TOP BAR END ***-->
</div>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a href="/" class="navbar-brand home">
            <img src="{{ URL::asset('/img/ezy2biz_logo.png') }}" alt="ezy2biz logo" class="d-none d-md-inline-block">
            <img src="{{ URL::asset('/img/ezy2biz_logo.png') }}" alt="ezy2biz logo" class="d-inline-block d-md-none">
            <span class="sr-only">ezy2biz - Go to homepage</span>
        </a>
        <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-align-justify"></i>
            </button>
           
           
        </div>
        <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="/" class="nav-link {{ $homeClass }}">Home</a></li>
                <li class="nav-item"><a href="/products" class="nav-link {{ $productClass }}">Product</a></li>
                <li class="nav-item"><a href="/bulletins" class="nav-link {{ $bulletinClass }}">Bulletin</a></li>
            </ul>
        </div>


        


    </div>
</nav>



@yield('bulletin-ticker')