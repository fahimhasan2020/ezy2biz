@extends('templates.admin.shell')

@section('body')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/a/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Add Product</li>
        </ol>

        <!-- Page Content -->
        <h1>Add New Product</h1>
        <hr>

        <form method="post" action="/a/product/add" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea name="description" class="form-control" rows="10" required></textarea>
            </div>
            <div class="form-group">
                <label>Sale Price</label>
                <input type="number" name="sale-price" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Wholesale Price</label>
                <input type="number" name="wholesale-price" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Commission (in &percnt;)</label>
                <input type="text" name="commission" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Add new photos (You can select multiple photos)</label>
                <input type="file" name="images[]" class="form-control-file" multiple>
            </div>
            <button type="submit" class="btn btn-success mb-5">Add Product</button>
        </form>

    </div>
@stop
