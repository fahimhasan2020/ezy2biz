@extends('templates.user.shell')

@section('body')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/u/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Referral Links</li>
        </ol>

        <!-- Page Content -->
        <h1>My Referral Links</h1>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Parent</th>
                            <th scope="col">Email</th>
                            <th scope="col">Link</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($refLinks as $refLink)
                            <tr>
                                <td>{{ $refLink->parent_fn }} {{ $refLink->parent_ln }}</td>
                                <td>{{ $refLink->parent_email }}</td>
                                <td>{{ url("/register?ref={$refLink->referral_key}") }}</td>
                                <td>{{ ucfirst($refLink->status) }}</td>
                                <td class="text-center">
                                    <a href="{{ url("/register?ref={$refLink->referral_key}") }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-globe" title="Go"></i></i>
                                    </a>
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


{{--@foreach($refLinks as $refLink)
<ul>
    <li>{{ url("/u/register?ref={$refLink->referral_key}") }}</li>
    <li>{{ $refLink->parent_fn }} {{ $refLink->parent_ln }}</li>
    <li>{{ $refLink->parent_email }}</li>
    <li>{{ ucfirst($refLink->status) }}</li>
</ul>
@endforeach--}}
