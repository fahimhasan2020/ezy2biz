@extends('templates.admin.shell')

@section('body')
<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/a/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- Icon Cards-->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">
                        @if($totalProductOrders < 2)
                            {{ $totalProductOrders }} Pending Product Order!
                        @else
                            {{ $totalProductOrders }} Pending Product Orders!
                        @endif
                    </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/a/product-orders">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-list"></i>
                    </div>
                    <div class="mr-5">
                        @if($totalPointRequests < 2)
                            {{ $totalPointRequests }} Pending Point Request!
                        @else
                            {{ $totalPointRequests }} Pending Point Requests!
                        @endif
                    </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/a/point-requests">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                    </div>
                    <div class="mr-5">
                        @if($totalWithdrawRequests < 2)
                            {{ $totalWithdrawRequests }} Pending Withdraw Request!
                        @else
                            {{ $totalWithdrawRequests }} Pending Withdraw Requests!
                        @endif
                    </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/a/withdraw-requests">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-life-ring"></i>
                    </div>
                    <div class="mr-5">
                        @if($totalUsers < 2)
                            {{ $totalUsers }} Registered User!
                        @else
                            {{ $totalUsers }} Registered Users!
                        @endif
                    </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/a/users">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                </a>
            </div>
        </div>
    </div>



</div>
@stop