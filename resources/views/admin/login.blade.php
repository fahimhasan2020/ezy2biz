@extends('templates.admin-shell')

@section('body')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="/a/login">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter email" name="email" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter password" name="password" type="password">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit"  class="btn btn-lg btn-success btn-block">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop