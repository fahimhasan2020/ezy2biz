<?php $homeClass = $productClass = $bulletinClass = ''; ?>

@extends('templates.shell')

@section('body')
    <div id="content">
        <div class="container">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <!-- breadcrumb-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li aria-current="page" class="breadcrumb-item active">New account / Sign in</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6">
                    <div class="box">
                        <h1>New account</h1>
                        <p class="lead">Not our registered user yet?</p>

                        <hr>
                        <form action="{{ url()->full() }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="first-name">First Name</label>
                                <input id="first-name" name="first-name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name</label>
                                <input id="last-name" name="last-name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input id="phone" name="phone" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input id="address" name="address" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="referrer-id">Referrer ID</label>
                                <input type="hidden" name="referrer-id" value="{{ $refInfo['r_id'] }}">
                                <input id="parent-id" type="text" class="form-control" value="{{ $refInfo['r_fn'] }} {{ $refInfo['r_ln'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="parent-id">Parent ID</label>
                                <input type="hidden" name="parent-id" value="{{ $refInfo['p_id'] }}">
                                <input id="parent-id" type="text" class="form-control" value="{{ $refInfo['p_fn'] }} {{ $refInfo['p_ln'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Add Photo</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input id="confirm-password" name="confirm-password" type="password" class="form-control">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-user-md"></i> Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="box">
                        <h1>Login</h1>
                        <p class="lead">Already our user?</p>
                        <hr>
                        <form action="/u/login" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-sign-in"></i> Log in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{--<form action="{{url()->full()}}" method="post">
    @csrf
    <label>
        First Name:
        <input type="text" name="first-name">
    </label>
    <br>
    <label>
        Last Name:
        <input type="text" name="last-name">
    </label>
    <br>
    <label>
        Phone No.:
        <input type="text" name="phone">
    </label>
    <br>
    <label>
        Address:
        <input type="text" name="address">
    </label>
    <br>
    <label>
        Parent:
        <input type="hidden" name="parent-id" value="{{ $refInfo->p_id }}">
        <input type="text" value="{{ $refInfo->p_fn }} {{$refInfo->p_ln}}" readonly >
    </label>
    <br>
    <label>
        Referrer:
        <input type="hidden" name="referrer-id" value="{{ $refInfo->r_id }}">
        <input type="text" value="{{ $refInfo->r_fn }} {{$refInfo->r_ln}}" readonly>
    </label>
    <br>
    <label>
        Email:
        <input type="email" name="email">
    </label>
    <br>
    <label>
        Password:
        <input type="password" name="password">
    </label>
    <br>
    <label>
        Confirm Password:
        <input type="password" name="confirm-password">
    </label>
    <br>
    <label>
        <input type="submit" name="submit" value="Register">
    </label>
</form>--}}