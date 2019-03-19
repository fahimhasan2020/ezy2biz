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
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col" class="text-right">Sale Price</th>
                            <th scope="col" class="text-right">Wholesale Price</th>
                            <th scope="col" class="text-right">Commission(&percnt;)</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)
                            <tr>
                                <td><img src="{{ Storage::url('' . $product->image_paths[0]) }}" height="50" /> </td>
                                <td>{{ $product->name }}</td>
                                <td class="text-right">{{ $product->sale_price }}</td>
                                <td class="text-right">{{ $product->wholesale_price }}</td>
                                <td class="text-right">{{ $product->commission }}</td>
                                <td class="text-center">
                                    <a href="/a/product/{{ $product->id }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-eye" title="View"></i>
                                    </a>
                                    <a href="/a/product/{{ $product->id }}/edit" class="btn btn-sm btn-info">
                                        <i class="far fa-edit" title="Edit"></i>
                                    </a>
                                    <form class="d-inline">
                                        <input type="hidden" name="id" value="{{ $product->id }}">
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