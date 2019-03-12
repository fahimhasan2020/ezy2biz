<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>This is Admin Edit Product page</h1>
<hr>
<ul>
    <li><a href="/a/bulletins">All Bulletins</a></li>
    <li><a href="/a/users">All Users</a></li>
    <li><a href="/a/settings">Settings</a></li>
    <li><a href="/a/logout">Logout</a></li>
</ul>
<hr>
<form action="{{ route('admin.edit-product', $product->id) }}" method="post" enctype="multipart/form-data">
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
</form>
</body>
</html>