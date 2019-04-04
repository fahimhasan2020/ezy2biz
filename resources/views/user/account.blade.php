<?php $accountActive = 'active'; $treeActive = ''; ?>
@extends('templates.user.shell')

@section('specific-css')
    <link rel="stylesheet" href="{{ URL::asset('/css/user-profile.css') }}">
@stop

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">My Account</li>
        </ol>

        <!-- Page Content -->
        <div class="row">
            <h1 class="col-md-6">Account</h1>
            <div class="col-md-6">
                @foreach($bankingAccounts as $account)
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
        </div>


        <div class="container emp-profile">
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
                            <p class="profile-rating">POINTS : <span>{{ $user->points }}</span></p>
                            <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                                @if($action)
                                    <?php $profileClass = ''; $transactionClass = 'show active'; ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Transaction</a>
                                    </li>
                                @else
                                    <?php $profileClass = 'show active'; $transactionClass = ''; ?>
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

                                <div class="tab-pane fade {{ $transactionClass }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    @if($action === 'transfer')
                                        <form action="/u/account/transfer" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="recipient">Send to</label>
                                                <input id="recipient" name="recipient" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Send Amount (Points)</label>
                                                <input id="amount" name="amount" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input id="password" name="password" type="password" class="form-control" required>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-paper-plane"></i> Send
                                                </button>
                                            </div>
                                        </form>
                                    @elseif($action === 'request')
                                        <form action="/u/account/req" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="bkash-num">Enter Your bKash/Rocket Number</label>
                                                <input id="bkash-num" name="bkash-num" type="text" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Send Amount (Cash)</label>
                                                <input id="amount" name="amount" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Enter Password to Proceed</label>
                                                <input id="password" name="password" type="password" class="form-control" required>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-exchange-alt"></i> Request
                                                </button>
                                            </div>
                                        </form>
                                    @elseif($action === 'withdraw')
                                        <form action="/u/account/withdraw" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="bkash-num">Enter Your bKash/Rocket Number</label>
                                                <input id="bkash-num" name="bkash-num" type="text" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Withdraw Amount (Points)</label>
                                                <input id="amount" name="amount" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Enter Password to Proceed</label>
                                                <input id="password" name="password" type="password" class="form-control" required>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-upload"></i> Withdraw
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                    </div>
                    <div class="col-md-2">
                        <a href="/u/account/edit" class="btn btn-outline-success">Edit Account</a>
                    </div>
                </div>
        </div>
    </div>
@stop