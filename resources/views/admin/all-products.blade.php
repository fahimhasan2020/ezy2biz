<?php $dashboardActive = $productsActive = $bulletinsActive = $ordersActive = $requestsActive = $usersActive = $accountActive = ''; $productsActive = 'active'; ?>
@extends('templates.admin.shell')

@section('body')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Products</li>
        </ol>

        <!-- Page Content -->
        <h1>All Products</h1>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col" class="text-right">Sale Price</th>
                            <th scope="col" class="text-right">Wholesale Price</th>
                            <th scope="col" class="text-right">Commission(&percnt;)</th>
                            <th scope="col" class="text-right">Photos</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td class="text-right">{{ $product->sale_price }}</td>
                                <td class="text-right">{{ $product->wholesale_price }}</td>
                                <td class="text-right">{{ $product->commission }}</td>
                                <td class="text-right">{{ count($product->image_paths) }}</td>
                                <td class="text-center">
                                    <a href="/product/{{ $product->id }}" class="btn btn-sm btn-success my-1">
                                        <i class="fas fa-eye" title="View"></i>
                                    </a>
                                    <a href="/a/product/{{ $product->id }}/edit" class="btn btn-sm btn-info my-1">
                                        <i class="far fa-edit" title="Edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger my-1" data-toggle="modal" data-target="#deleteProduct{{ $product->id }}">
                                        <i class="fa fa-trash" title="Delete"></i>
                                    </a>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteProduct{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="product{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="product{{ $product->id }}">Confirmation</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Do you really want to delete the product? Select "Yes" below if you want to proceed and remove the product. Remember, this action is irreversible.</div>
                                        <div class="modal-footer">
                                            <form class="d-inline" action="/a/product/delete" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $product->id }}">
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
                            <a class="page-link" href="/a/products?page={{ $prevPage }}" tabindex="-1">Previous</a>
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
                                    <a class="page-link" href="/a/products?page={{ $i }}">{{ $i }}</a>
                                </li>
                        @endif
                    @endfor
                    @if($nextPage)
                        <li class="page-item">
                            <a class="page-link" href="/a/products?page={{ $nextPage }}">Next</a>
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