@extends('templates.user.shell')

@section('specific-css')
    <link rel="stylesheet" href="{{ URL::asset('/css/user-profile.css') }}">
@stop

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/u/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Account</li>
        </ol>

        <!-- Page Content -->
        <h1>Account</h1>

        <div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="{{ Storage::url('' . $user->photo) }}" alt=""/>
                        </div>

                        <div class="profile-work">
                            <a class="btn btn-sm btn-outline-info btn-block" href="/u/account?action=transfer">Point Transfer</a><br/>
                            <a class="btn btn-sm btn-outline-info btn-block" href="/u/account?action=request">Point Request</a><br/>
                            <a class="btn btn-sm btn-outline-info btn-block" href="/u/account?action=withdraw">Cash Withdraw</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                {{ $user->first_name }} {{ $user->last_name }}
                            </h5>
                            <p class="profile-rating">STEP : <span>{{ $user->step }}</span></p>
                            <p class="profile-rating">Points : <span>{{ $user->points }}</span></p>
                            <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                </li>
                                @if($action)
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Transaction</a>
                                    </li>
                                @endif
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
                                </div>

                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    @if($action === 'transfer')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Experience</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                    @elseif($action === 'request')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Hourly Rate</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>10$/hr</p>
                                            </div>
                                        </div>
                                    @elseif($action === 'withdraw')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Total Projects</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>230</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>English Level</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Expert</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Availability</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>6 months</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Your Bio</label><br/>
                                            <p>Your detail description</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-2">
                        <a href="#" class="btn btn-outline-success">Edit Account</a>
                    </div>
                </div>
                <div class="row">


                </div>
            </form>
        </div>
    </div>
@stop

{{--
<template>
User: {{ $user->first_name }} {{ $user->last_name }}
Active: @if($user->is_active) Yes @else No @endif
Points: {{ $user->points }}
<hr>
@if ($action === 'transfer')
    <form action="/u/account/transfer" method="post">
        @csrf
        <label>
            Send To:
            <input type="text" name="recipient">
        </label>
        <label>
            Amount:
            <input type="number" name="amount">
        </label>
        <label>
            <input type="submit" name="submit" value="Send">
        </label>
    </form>

@elseif($action === 'request')
    <form action="/u/account/req" method="post">
        @csrf
        <label>
            bKash Number:
            <input type="text" name="bkash-num">
        </label>
        <label>
            Amount:
            <input type="number" name="amount">
        </label>
        <label>
            <input type="submit" name="submit" value="Request Points">
        </label>
    </form>

@elseif($action === 'withdraw')
    <form action="/u/account/withdraw" method="post">
        @csrf
        <label>
            bKash Number:
            <input type="text" name="bkash-num">
        </label>
        <label>
            Amount (Points):
            <input type="number" name="amount">
        </label>
        <label>
            <input type="submit" name="submit" value="Request Withdrawal">
        </label>
    </form>
@endif
</template>--}}