<?php $dashboardActive = $productsActive = $bulletinsActive = $ordersActive = $requestsActive = $usersActive = $accountActive = ''; $requestsActive = 'active'; ?>
@extends('templates.admin.shell')

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Withdraw Requests</li>
        </ol>

        <!-- Page Content -->
        <h1>Cash Withdraw Requests</h1>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Applicant Name</th>
                            <th scope="col">Contact Info</th>
                            <th scope="col" class="text-right">Amount (Points)</th>
                            <th scope="col" class="text-right">bKash No.</th>
                            <th scope="col" class="text-center">Allowed Cash</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($requests as $request)
                            <form action="/a/withdraw-requests" method="post">
                                @csrf
                                <tr>
                                    <td>{{ $request->first_name }} {{ $request->last_name }}</td>
                                    <td>{{ $request->phone }}</td>
                                    <td class="text-right">{{ $request->amount }}</td>
                                    <td class="text-right">{{ $request->bkash_no }}</td>
                                    <td class="text-right">
                                        <input class="form-control" name="cash" type="number" required/>
                                    </td>
                                    <td class="text-center">
                                        <input class="form-control" name="points" type="hidden" value="{{ $request->amount }}" />
                                        <input type="hidden" name="request-id" value="{{ $request->id }}">
                                        <input type="hidden" name="applicant-id" value="{{ $request->applicant_id }}">
                                        <input type="hidden" name="response" value="accept">
                                        <button type="submit" class="btn btn-sm btn-success my-1">
                                            <i class="fas fa-check" title="Complete"></i>
                                        </button>

                                        <a href="#" class="btn btn-sm btn-danger my-1" data-toggle="modal" data-target="#productOrder{{$request->id}}">
                                            <i class="fas fa-times" title="Reject"></i>
                                        </a>
                                    </td>
                                </tr>
                            </form>

                            <div class="modal fade" id="productOrder{{ $request->id }}" tabindex="-1" role="dialog" aria-labelledby="order{{ $request->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="order{{ $request->id }}">Confirmation</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Do you really want to reject the request? Select "Yes" below if you want to proceed and cancel the request. Remember, this action is irreversible.</div>
                                        <div class="modal-footer">
                                            <form class="d-inline" action="/a/withdraw-requests" method="post">
                                                @csrf
                                                <input type="hidden" name="request-id" value="{{ $request->id }}">
                                                <input type="hidden" name="response" value="reject">
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

    </div>
    <!-- /.container-fluid -->
@stop