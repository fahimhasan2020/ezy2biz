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
            <li class="breadcrumb-item active">Edit User</li>
        </ol>

        <!-- Page Content -->
        <h1>Edit User</h1>
        <hr>

        <form method="post" action="/a/user/{{ $user->id }}" class="mb-5">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Referrer ID</label>
                <input type="text" name="referrer-id" class="form-control" value="{{ $user->referrer_id }}" required>
            </div>
            <div class="form-group">
                <label>Parent ID</label>
                <input type="text" name="parent-id" class="form-control" value="{{ $user->parent_id }}" required>
            </div>

            <button type="submit" class="btn btn-info">Update User</button>
            <hr>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" value="{{ $user->first_name }}" readonly>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" value="{{ $user->last_name }}" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" value="{{ $user->email }}" readonly>
            </div>
            <div class="form-group">
                <label>Phone No.</label>
                <input type="text" class="form-control" value="{{ $user->phone }}" readonly>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" value="{{ $user->address }}" readonly>
            </div>
        </form>

    </div>
@stop