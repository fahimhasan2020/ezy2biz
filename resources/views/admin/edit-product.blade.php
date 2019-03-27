@extends('templates.admin.shell')

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/a/products">All Products</a>
            </li>
            <li class="breadcrumb-item active">Edit Product</li>
        </ol>

        <!-- Page Content -->
        <h1>Edit Product</h1>
        <hr>

        <form method="post" action="/a/product/{{ $product->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea name="description" class="form-control" rows="10" required>{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label>Sale Price</label>
                <input type="number" name="sale-price" class="form-control" value="{{ $product->sale_price }}" required>
            </div>
            <div class="form-group">
                <label>Wholesale Price</label>
                <input type="number" name="wholesale-price" class="form-control" value="{{ $product->wholesale_price }}" required>
            </div>
            <div class="form-group">
                <label>Commission (in &percnt;)</label>
                <input type="text" name="commission" class="form-control" value="{{ $product->commission }}" required>
            </div>
            <div class="form-group">
                <label class="mr-3">Check photos to delete:</label>
                @foreach($product->image_paths as $image)
                    <label class="mr-5">
                    <input type="checkbox" name="delete-images[]" class="form-check form-check-inline" value="{{ $image }}">
                    <img src="{{ Storage::url('' . $image) }}" alt="" height="60">
                    </label>
                @endforeach
            </div>
            <div class="form-group">
                <label>Add new photos (You can select multiple photos)</label>
                <input type="file" name="images[]" class="form-control-file" multiple>
            </div>
            <button type="submit" class="btn btn-info mb-5">Update Product</button>
        </form>

    </div>
@stop
