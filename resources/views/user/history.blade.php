<?php $accountActive = ''; $treeActive = ''; $historyActive = 'active'; ?>
@extends('templates.user.shell')

@section('body')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Commission History</li>
        </ol>

        <!-- Page Content -->
        <h1>My Commissions</h1>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Description</th>
                            <th scope="col" class="text-right">Points</th>
                            <th scope="col" class="text-center">Issue Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($histories as $history)
                            <tr>
                                <td>{{ $history->commission_type }}</td>
                                <td>{{ $history->description }}</td>
                                <td class="text-right">{{ $history->amount }}</td>
                                <td class="text-center">{{ $history->issue_datetime }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop