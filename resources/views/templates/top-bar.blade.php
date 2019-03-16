<div id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offer mb-3 mb-lg-0"></div>
            <div class="col-lg-6 text-center text-lg-right">
                <ul class="menu list-inline mb-0">
                    <li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                    <li class="list-inline-item"><a href="/u/register">Register</a></li>
                    <li class="list-inline-item"><a href="#">Account</a></li>

                </ul>
            </div>
        </div>
    </div>
    <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer login</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="/u/login" method="post">
                        @csrf
                        <div class="form-group">
                            <input id="email-modal" name="email" type="text" placeholder="Enter email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input id="password-modal" name="password" type="password" placeholder="Enter password" class="form-control">
                        </div>
                        <p class="text-center">
                            <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                        </p>
                    </form>
                    <p class="text-center text-muted">Not registered yet?</p>
                    <p class="text-center text-muted">
                        <a href="/u/register">
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
            <img src="{{ URL::asset('/img/ezy2biz.png') }}" alt="ezy2biz logo" class="d-none d-md-inline-block">
            <img src="{{ URL::asset('/img/logo-small.png') }}" alt="ezy2biz logo" class="d-inline-block d-md-none">
            <span class="sr-only">ezy2biz - Go to homepage</span>
        </a>
        <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-align-justify"></i>
            </button>
            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler">
                <span class="sr-only">Toggle search</span>
                <i class="fa fa-search"></i>
            </button>
            <a href="basket.html" class="btn btn-outline-secondary navbar-toggler">
                <i class="fa fa-shopping-cart"></i>
            </a>
        </div>
        <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="/" class="nav-link {{ $homeClass }}">Home</a></li>
                <li class="nav-item"><a href="/products" class="nav-link {{ $productClass }}">Product</a></li>
                <li class="nav-item"><a href="/bulletins" class="nav-link {{ $bulletinClass }}">Bulletin</a></li>
            </ul>
        </div>


        <div class="navbar-buttons d-flex justify-content-end">
            <!-- /.nav-collapse-->
            <div id="search-not-mobile" class="navbar-collapse collapse"></div>
            <a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block">
                <span class="sr-only">Toggle search</span>
                <i class="fa fa-search"></i>
            </a>
            <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block">
                <a href="basket.html" class="btn btn-primary navbar-btn">
                    <i class="fa fa-shopping-cart"></i>
                    <span>3 items in cart</span>
                </a>
            </div>
        </div>


    </div>
</nav>

<div id="search" class="collapse">
    <div class="container">
        <form role="search" class="ml-auto">
            <div class="input-group">
                <input type="text" placeholder="Search" class="form-control">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>