@extends('templates.admin.shell')

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Add Bulletin</li>
        </ol>

        <!-- Page Content -->
        <h1>Add New Bulletin</h1>
        <hr>

        <form method="post" action="/a/bulletin/add" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="10" required></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-5">Create Bulletin</button>
        </form>

    </div>
@stop