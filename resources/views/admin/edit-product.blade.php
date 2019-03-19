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

        <form method="post" action="/a/product/{{ $product->id }}/edit">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="exampleFormControlInput1">Product Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Product Name">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect2">Example multiple select</label>
                <select multiple class="form-control" id="exampleFormControlSelect2">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </form>

    </div>
@stop

{{--<form action="{{ route('admin.edit-product', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>
        Product Name:
        <input type="text" name="name" value="{{ $product->name }}">
    </label>
    <br>
    <label>
        Product Description:
        <textarea name="description" cols="80" rows="20" placeholder="Write description...">{{ $product->description }}</textarea>
    </label>
    <br>
    <label>
        Sale Price:
        <input type="number" name="sale-price" value="{{ $product->sale_price }}">
    </label>
    <br>
    <label>
        Wholesale Price:
        <input type="number" name="wholesale-price" value="{{ $product->wholesale_price }}">
    </label>
    <br>
    <label>
        Commission: (In percentage)
        <input type="number" name="commission" value="{{ $product->commission }}"> &percnt;
    </label>
    <br>
    <label>
        Product Image:
        @foreach($product->image_paths as $image)
            <input type="checkbox" name="delete-images[]" value="{{ $image }}">
            <img alt="" src="{{Storage::url('' . $image)}}" height="100">
        @endforeach
        <br>
        Add Images:
        <input type="file" name="images[]" multiple>
    </label>
    <br>
    <label>
        <input type="submit" name="submit" value="Update Product">
    </label>
</form>--}}
