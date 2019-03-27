@extends('templates.user.shell')

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/u/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Settings</li>
        </ol>

        <!-- Page Content -->
        <h1 class="col-md-8">Settings</h1>
        <hr>

        <form class="col-md-8" action="/u/settings" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="change-email">Change Email (Leave it blank if you don't want to change email)</label>
                <input id="change-email" name="change-email" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="change-password">Change Password (Leave it blank if you don't want to change password)</label>
                <input id="change-password" name="change-password" type="password" class="form-control">
            </div>
            <hr>
            <div class="form-group">
                <label for="password">Enter Current Password to Proceed</label>
                <input id="password" name="password" type="password" class="form-control" required>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Update
                </button>
            </div>
        </form>
    </div>
@stop