@extends('templates.admin.shell')

@section('body')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Users</li>
        </ol>

        <!-- Page Content -->
        <h1>All Users</h1>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped pre-scrollable">
                        <thead>
                        <tr>
                            <th scope="col" class="text-right">User ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact No.</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-right">Step</th>
                            <th scope="col" class="text-right">Points</th>
                            <th scope="col">Parent</th>
                            <th scope="col">Referrer</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td class="text-right">{{ $user->id }}</td>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-right">{{ $user->step }}</td>
                                <td class="text-right">{{ $user->points }}</td>
                                <td>
                                    <a href="/a/user/{{ $user->parent_id }}">{{ $user->parent_fn }} {{ $user->parent_ln }}</a>
                                </td>
                                <td>
                                    <a href="/a/user/{{ $user->parent_id }}">{{ $user->referrer_fn }} {{ $user->referrer_ln }}</a>
                                </td>
                                <td class="text-center">
                                    <a href="/a/user/{{ $user->id }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-eye" title="View"></i>
                                    </a>
                                    <a href="/a/user/{{ $user->id }}/edit" class="btn btn-sm btn-info">
                                        <i class="far fa-edit" title="Edit"></i>
                                    </a>
                                    {{--<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteUser{{ $user->id }}">
                                        <i class="fa fa-trash" title="Delete"></i>
                                    </a>--}}
                                </td>
                            </tr>

                            {{--<div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="user{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="user{{ $user->id }}">Confirmation</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Do you really want to delete the user? Select "Yes" below if you want to proceed and remove the user. Remember, this action is irreversible.</div>
                                        <div class="modal-footer">
                                            <form class="d-inline" action="/a/user/delete" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="user-id" value="{{ $user->id }}">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                                                <button class="btn btn-danger">Yes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop