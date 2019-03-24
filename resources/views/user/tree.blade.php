@extends('templates.user.shell')

@section('specific-css')
    <style>
        .table-tree-container {
            position: relative;
            height: 535px;
            width: 80vw;
            overflow: auto;
            background-image: url("{{ URL::asset('/img/wood-background.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .table-tree {
            position: absolute;
            top: 8px; left: 0;
            width: 1600px;
            color: #000000;
        }
        .table-tree a:link {
            color: #333;
        }
        .table-tree a:visited {
            color: #333;
        }
        .table-tree a:hover {
            color: #ddd;
        }
        .table-tree-container .table-tree tr {
            height: 100px;
        }
        .table-tree-container .table-tree tr td {
            width: 100px;
        }
        .table-tree-container .table-tree tr p {
            font-size: 14px;
            margin: 0;
        }
    </style>
@stop

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Tree</li>
        </ol>

        <!-- Page Content -->
        <h1>Referral Tree</h1>
        <hr>

        <div class="table-tree-container mb-5">
            <table class="table text-center table-tree" align="center" border="1">
                <tr>
                    <td colspan="16"><a href="#"><i class="fas fa-user-circle fa-2x"></i></a>
                        <p>
                            {{ $currentUser->first_name }} {{ $currentUser->last_name }} <br>
                            STEP: {{ $currentUser->step }} <br>
                            ACTIVE: @if($currentUser->is_active) Yes @else No @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    @for($i = 1; $i <= 2; $i++)
                        <td colspan="8">
                            @if (is_object($tree[$i]))
                                <a href="#"><i class="fas fa-user-circle fa-2x"></i></a>
                                <p>
                                    {{ $tree[$i]->first_name }} {{ $tree[$i]->last_name }} <br>
                                    STEP: {{ $tree[$i]->step }} <br>
                                    ACTIVE: @if($tree[$i]->is_active) Yes @else No @endif
                                </p>
                            @elseif (!is_null($tree[$i]))
                                <a href="#" data-toggle="modal" data-target="#refLink{{ $i }}">
                                    <i class="fas fa-plus-circle fa-2x"></i>
                                </a>
                                <p>Join new user</p>

                                <form action="/u/ref-link" method="post">
                                    @csrf
                                    <div class="modal fade" id="refLink{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="refLink{{ $i }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="refLink{{ $i }}Label">Confirmation</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Do you want to create a registration referral link? Click the 'Generate' button below to proceed.</div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="parent-id" value="{{ $tree[$i] }}">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" href="/a/logout">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </td>
                    @endfor
                </tr>
                <tr>
                    @for($i = 3; $i <= 6; $i++)
                        <td colspan="4">
                            @if (is_object($tree[$i]))
                                <a href="#"><i class="fas fa-user-circle fa-2x"></i></a>
                                <p>
                                    {{ $tree[$i]->first_name }} {{ $tree[$i]->last_name }} <br>
                                    STEP: {{ $tree[$i]->step }} <br>
                                    ACTIVE: @if($tree[$i]->is_active) Yes @else No @endif
                                </p>
                            @elseif (!is_null($tree[$i]))
                                <a href="#" data-toggle="modal" data-target="#refLink{{ $i }}">
                                    <i class="fas fa-plus-circle fa-2x"></i>
                                </a>
                                <p>Join new user</p>

                                <form action="/u/ref-link" method="post">
                                    @csrf
                                    <div class="modal fade" id="refLink{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="refLink{{ $i }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="refLink{{ $i }}Label">Confirmation</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Do you want to create a registration referral link? Click the 'Generate' button below to proceed.</div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="parent-id" value="{{ $tree[$i] }}">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" href="/a/logout">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </td>
                    @endfor
                </tr>
                <tr>
                    @for($i = 7; $i <= 14; $i++)
                        <td colspan="2">
                            @if (is_object($tree[$i]))
                                <a href="#"><i class="fas fa-user-circle fa-2x"></i></a>
                                <p>
                                    {{ $tree[$i]->first_name }} {{ $tree[$i]->last_name }} <br>
                                    STEP: {{ $tree[$i]->step }} <br>
                                    ACTIVE: @if($tree[$i]->is_active) Yes @else No @endif
                                </p>
                            @elseif (!is_null($tree[$i]))
                                <a href="#" data-toggle="modal" data-target="#refLink{{ $i }}">
                                    <i class="fas fa-plus-circle fa-2x"></i>
                                </a>
                                <p>Join new user</p>

                                <form action="/u/ref-link" method="post">
                                    @csrf
                                    <div class="modal fade" id="refLink{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="refLink{{ $i }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="refLink{{ $i }}Label">Confirmation</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Do you want to create a registration referral link? Click the 'Generate' button below to proceed.</div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="parent-id" value="{{ $tree[$i] }}">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" href="/a/logout">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </td>
                    @endfor
                </tr>
                <tr>
                    @for($i = 15; $i <= 30; $i++)
                        <td>
                            @if (is_object($tree[$i]))
                                <a href="#"><i class="fas fa-user-circle fa-2x"></i></a>
                                <p>
                                    {{ $tree[$i]->first_name }} {{ $tree[$i]->last_name }} <br>
                                    STEP: {{ $tree[$i]->step }} <br>
                                    ACTIVE: @if($tree[$i]->is_active) Yes @else No @endif
                                </p>
                            @elseif (!is_null($tree[$i]))
                                <a href="#" data-toggle="modal" data-target="#refLink{{ $i }}">
                                    <i class="fas fa-plus-circle fa-2x"></i>
                                </a>
                                <p>Join new user</p>

                                <form action="/u/ref-link" method="post">
                                    @csrf
                                    <div class="modal fade" id="refLink{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="refLink{{ $i }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="refLink{{ $i }}Label">Confirmation</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Do you want to create a registration referral link? Click the 'Generate' button below to proceed.</div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="parent-id" value="{{ $tree[$i] }}">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" href="/a/logout">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </td>
                    @endfor
                </tr>
            </table>
        </div>
    </div>
@stop

{{--
<template>
Name: {{ $currentUser->first_name }} {{ $currentUser->last_name }} <br>
Email: {{ $currentUser->email }} <br>
Active: @if($currentUser->is_active) Yes @else No @endif <br>
ID: {{ $currentUser->id }} <br>
<hr>
<form action="{{ route('user.ref-link') }}" method="post">
    @csrf
    <labe>
        Parent:
        <input type="text" name="parent-id">
    </labe>
    <labe>
        <input type="submit" name="submit" value="Generate Referral Link">
    </labe>
</form>
</template>--}}