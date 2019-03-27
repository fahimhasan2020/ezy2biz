@extends('templates.admin.shell')

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/a/bulletins">All Bulletins</a>
            </li>
            <li class="breadcrumb-item active">Edit Bulletin</li>
        </ol>

        <!-- Page Content -->
        <h1>Edit Bulletin</h1>
        <hr>

        <form method="post" action="/a/bulletin/{{ $bulletin->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $bulletin->title }}" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="10" required>{{ $bulletin->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-success mb-5">Create Bulletin</button>
        </form>

    </div>
@stop