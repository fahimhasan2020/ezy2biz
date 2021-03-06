<?php $dashboardActive = $productsActive = $bulletinsActive = $ordersActive = $requestsActive = $usersActive = $accountActive = ''; $requestsActive = 'active'; ?>
@extends('templates.admin.shell')

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/a/withdraw-requests">Withdraw Requests</a>
            </li>
            <li class="breadcrumb-item active">Withdraw History</li>
        </ol>

        <!-- Page Content -->
        <div class="row">
            <h1 class="col-md-6">Cash Withdraw History</h1>
            <div class="col-md-6 text-md-right">
                <a class="btn btn-info" href="/a/withdraw-requests/">
                    <i class="fas fa-exchange-alt"></i> Pending Requests
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Date</th>
                            <th scope="col">Applicant Name</th>
                            <th scope="col" class="text-center">Contact Info</th>
                            <th scope="col" class="text-right">Amount (Points)</th>
                            <th scope="col" class="text-center">bKash/Rocket No.</th>
                            <th scope="col" class="text-right">Cash Sent</th>
                            <th scope="col">Response</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($requests as $request)
                            <form action="/a/withdraw-requests" method="post">
                                @csrf
                                <tr>
                                    <td class="text-center">{{ $request->timestamp }}</td>
                                    <td>{{ $request->first_name }} {{ $request->last_name }}</td>
                                    <td class="text-center">{{ $request->phone }}</td>
                                    <td class="text-right">{{ $request->amount }}</td>
                                    <td class="text-center">{{ $request->bkash_no }}</td>
                                    <td class="text-right">{{ $request->allowed_cash }}</td>
                                    <td>
                                        @if($request->response == 'accept')
                                            <strong>Accepted</strong>
                                        @else
                                            <strong>Rejected</strong>
                                        @endif
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

            <nav class="container">
                <ul class="pagination">
                    @if($prevPage)
                        <li class="page-item">
                            <a class="page-link" href="/a/withdraw-requests/history?page={{ $prevPage }}" tabindex="-1">Previous</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                    @endif
                    @for($i = 1; $i <= $totalPages; $i++)
                        @if ($i == $curPage)
                            <li class="page-item active"><a class="page-link" href="#">{{ $i }}</a></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="/a/withdraw-requests/history?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor
                    @if($nextPage)
                        <li class="page-item">
                            <a class="page-link" href="/a/withdraw-requests/history?page={{ $nextPage }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

    </div>
    <!-- /.container-fluid -->
@stop