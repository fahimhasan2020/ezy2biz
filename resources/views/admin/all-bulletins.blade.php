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
                                <td>{{ strftime('%a, %B %e, %Y', strtotime($bulletin->publish_date)) }}</td>
                                <td class="text-center">
                                    <a href="/a/bulletin/{{ $bulletin->id }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-eye" title="View"></i>
                                    </a>
                                    <a href="/a/bulletin/{{ $bulletin->id }}/edit" class="btn btn-sm btn-info">
                                        <i class="far fa-edit" title="Edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteBulletin{{$bulletin->id}}">
                                        <i class="fa fa-trash" title="Delete"></i>
                                    </a>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteBulletin{{$bulletin->id}}" tabindex="-1" role="dialog" aria-labelledby="bulletin{{$bulletin->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="bulletin{{$bulletin->id}}">Confirmation</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Do you really want to delete the bulletin? Select "Yes" below if you want to proceed and remove the bulletin. Remember, this action is irreversible.</div>
                                        <div class="modal-footer">
                                            <form class="d-inline" action="/a/bulletin/delete" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $bulletin->id }}">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                                                <button class="btn btn-danger">Yes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <nav class="container">
                <ul class="pagination">
                    @if($prevPage)
                        <li class="page-item">
                            <a class="page-link" href="/a/bulletins?page={{ $prevPage }}" tabindex="-1">Previous</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                    @endif
                    @for($i = 1; $i <= $totalPages; $i++)
                        @if ($i == $curPage)
                            <li class="page-item active"><a class="page-link" href="#">{{ $i }}</a></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="/a/bulletins?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor
                    @if($nextPage)
                        <li class="page-item">
                            <a class="page-link" href="/a/bulletins?page={{ $nextPage }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@stop