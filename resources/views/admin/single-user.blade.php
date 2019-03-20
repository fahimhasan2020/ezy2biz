@extends('templates.admin.shell')

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
            <li class="breadcrumb-item active">User Profile</li>
        </ol>

        <!-- Page Content -->
        <h1>User Profile</h1>

    </div>
@stop