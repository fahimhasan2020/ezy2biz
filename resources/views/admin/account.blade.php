<?php $dashboardActive = $productsActive = $bulletinsActive = $ordersActive = $requestsActive = $usersActive = $accountActive = ''; $accountActive = 'active'; ?>
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
            <li class="breadcrumb-item active">Account</li>
        </ol>

        <!-- Page Content -->
        <h1>Account</h1>

        <div class="container emp-profile">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <a class="btn btn-sm btn-outline-info btn-block" href="/a/account?action=bkash">Change bKash Account</a><br/>
                        <a class="btn btn-sm btn-outline-info btn-block" href="/a/account?action=rocket">Change Rocket Account</a><br/>
                        <a class="btn btn-sm btn-outline-info btn-block" href="/a/account?action=profile">Change Profile Info</a><br/>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="profile-head row">
                        <h5 class="col-md-4">Account Numbers</h5>
                        <div class="col-md-8">
                            @foreach($accounts as $account)
                                @if($account->account_name == 'bkash')
                                    <p class="profile-rating container clearfix">
                                <span class="float-right" style="margin-left: 15px;">
                                    {{ $account->account_number }}</span>
                                        <span class="float-right">
                                    <img src="{{ URL::asset('/img/bkash-logo.png') }}" alt="" style="height: 18px; vertical-align: -20%">
                                    bKash:
                                </span>
                                    </p>
                                @elseif($account->account_name == 'rocket')
                                    <p class="profile-rating container">
                                <span class="float-right" style="margin-left: 15px;">
                                    {{ $account->account_number }}</span>
                                        <span class="float-right">
                                    <img src="{{ URL::asset('/img/rocket-logo.png') }}" alt="" style="height: 18px; vertical-align: -20%">
                                    Rocket:
                                </span>
                                    </p>
                                @endif
                            @endforeach
                        </div>
                        <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                            @if($action)
                                <?php $profileClass = ''; $editClass = 'show active'; ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Edit</a>
                                </li>
                            @else
                                <?php $profileClass = 'show active'; $editClass = ''; ?>
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade {{ $profileClass }}" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Admin Id</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $admin->id }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $admin->first_name }} {{ $admin->last_name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $admin->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade {{ $editClass }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @if($action === 'bkash')
                                <form action="/a/account/bkash" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="bkash">New bKash Number</label>
                                        <input id="bkash" name="bkash" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Enter Password to Proceed</label>
                                        <input id="password" name="password" type="password" class="form-control" required>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-edit"></i> Apply
                                        </button>
                                    </div>
                                </form>
                            @elseif($action === 'rocket')
                                <form action="/a/account/rocket" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="rocket">New Rocket Number</label>
                                        <input id="rocket" name="rocket" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Enter Password to Proceed</label>
                                        <input id="password" name="password" type="password" class="form-control" required>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-edit"></i> Apply
                                        </button>
                                    </div>
                                </form>
                            @elseif($action === 'profile')
                                <form action="/a/account/profile" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="first-name">First Name</label>
                                        <input id="first-name" name="first-name" type="text" class="form-control"
                                        value="{{ $admin->first_name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name">Last Name</label>
                                        <input id="last-name" name="last-name" type="text" class="form-control"
                                        value="{{ $admin->last_name }}" required>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-edit"></i> Update
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop