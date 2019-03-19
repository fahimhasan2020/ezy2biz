@extends('templates.admin.shell')

@section('body')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Bulletins</li>
        </ol>

        <!-- Page Content -->
        <h1>All Bulletins</h1>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Publisher</th>
                            <th scope="col">Published Date</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($bulletins as $bulletin)
                            <tr>
                                <td>{{ $bulletin->title }}</td>
                                <td>{{ $bulletin->first_name }} {{ $bulletin->last_name }}</td>
                                <td>{{ strftime('%a, %e %B %Y', strtotime($bulletin->publish_date)) }}</td>
                                <td class="text-center">
                                    <a href="/a/bulletin/{{ $bulletin->id }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-eye" title="View"></i>
                                    </a>
                                    <a href="/a/bulletin/{{ $bulletin->id }}/edit" class="btn btn-sm btn-info">
                                        <i class="far fa-edit" title="Edit"></i>
                                    </a>
                                    <form class="d-inline">
                                        <input type="hidden" name="id" value="{{ $bulletin->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash" title="Delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop