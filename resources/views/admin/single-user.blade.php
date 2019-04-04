<?php $dashboardActive = $productsActive = $bulletinsActive = $ordersActive = $requestsActive = $usersActive = $accountActive = ''; $usersActive = 'active'; ?>
@extends('templates.admin.shell')

@section('specific-css')
    <link rel="stylesheet" href="{{ URL::asset('/css/user-profile.css') }}">
@stop

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/a/users">All Users</a>
            </li>
            <li class="breadcrumb-item active">User</li>
        </ol>

        <!-- Page Content -->
        <h1>User</h1>

        <div class="container emp-profile">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="{{ Storage::url('' . $user->photo) }}" alt=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            {{ $user->first_name }} {{ $user->last_name }}
                        </h5>
                        <p class="profile-rating">STEP : <span>{{ $user->step }}</span></p>
                        <p class="profile-rating">POINTS : <span>{{ $user->points }}</span></p>
                        <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>User Id</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $user->id }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $user->first_name }} {{ $user->last_name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $user->phone }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Address</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $user->address }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Parent</label>
                                </div>
                                <div class="col-md-6">
                                    @if($user->parent_id)
                                        <p><a href="/a/user/{{ $user->parent_id }}">
                                                {{ $user->parent_fn }} {{ $user->parent_ln }}</a></p>
                                    @else
                                        <p>None</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Referrer</label>
                                </div>
                                <div class="col-md-6">
                                    @if($user->referrer_id)
                                        <p><a href="/a/user/{{ $user->referrer_id }}">
                                                {{ $user->referrer_fn }} {{ $user->referrer_ln }}</a></p>
                                    @else
                                        <p>None</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="/a/user/{{ $user->id }}/edit" class="btn btn-outline-success">Edit Account</a>
                </div>
            </div>
        </div>
    </div>
@stop