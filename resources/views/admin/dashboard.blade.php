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

    <h3 class="mt-4">Landing Page Slides</h3>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Path</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($images as $image)
                        <tr>
                            <td><img src="{{ Storage::url($image->image_path) }}" alt="" height="60"></td>
                            <td>{{ $image->image_path }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteImage{{ $image->id }}">
                                    <i class="fa fa-trash" title="Delete"></i>
                                </a>
                            </td>
                        </tr>

                        <div class="modal fade" id="deleteImage{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="image{{ $image->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="image{{ $image->id }}">Confirmation</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Do you really want to delete the product? Select "Yes" below if you want to proceed and remove the product. Remember, this action is irreversible.</div>
                                    <div class="modal-footer">
                                        <form class="d-inline" action="/a/dashboard" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $image->id }}">
                                            <input type="hidden" name="image-path" value="{{ $image->image_path }}">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                                            <button class="btn btn-danger">Yes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form action="/a/dashboard" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Add new photos (You can select multiple photos)</label>
            <input type="file" name="images[]" class="form-control-file" multiple>
        </div>
        <button type="submit" class="btn btn-info mb-3">Add Image</button>
    </form>
</div>
@stop