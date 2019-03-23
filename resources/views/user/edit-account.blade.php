@extends('templates.user.shell')

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/u/account">My Account</a>
            </li>
            <li class="breadcrumb-item active">Edit Account</li>
        </ol>

        <!-- Page Content -->
        <h1>Edit Account</h1>
        <hr>

        <form action="/u/account/edit" method="post" enctype="multipart/form-data" class="mb-5">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input id="first-name" name="first-name" type="text" class="form-control" value="{{ $user->first_name }}">
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input id="last-name" name="last-name" type="text" class="form-control" value="{{ $user->last_name }}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input id="phone" name="phone" type="text" class="form-control" value="{{ $user->phone }}">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input id="address" name="address" type="text" class="form-control" value="{{ $user->address }}">
            </div>
            <div class="row">
                <div class="col-md-2">
                    <img src="{{ Storage::url('' . $user->photo) }}" alt="" style="width:inherit;">
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="photo">Update Photo</label>
                        <input id="photo" type="file" name="image" class="form-control-file">
                    </div>
                </div>
            </div>
            <hr>
            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="far fa-edit"></i> Update
                </button>
            </div>
        </form>

    </div>
@stop