<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/u/login', function () {
    return view('user.login');
})->middleware('user-logged');

Route::post('/u/login', 'UserController@login')->name('user.login');

Route::group(['middleware' => ['user-not-logged']], function () {

    Route::get('/u/logout', 'UserController@logout');

    Route::get('/u/dashboard', function () {
        return view('user.dashboard');
    });

    Route::get('/u/tree', function () {
        return view('user.tree');
    });

    Route::get('/u/ref-link', function () {
        return view('user.ref-link');
    });

    Route::get('/u/balance', function () {
        return view('user.balance');
    });

    Route::get('/u/balance/transfer', function () {
        return view('user.balance-transfer');
    });

    Route::get('/u/balance/req', function () {
        return view('user.balance-req');
    });

    Route::get('/u/settings', function () {
        return view('user.settings');
    });

});

Route::get('/u/register', function () {
    return view('user.register');
});

Route::post('/u/register', 'UserController@register')->name('user.register');

Route::get('/products', function () {
    return view('product.all');
});

Route::get('/product/{id}', function () {
    return view('product.single');
});

Route::get('/product/{id}/buy', function () {
    return view('product.buy');
});

Route::get('/bulletins', function () {
    return view('bulletin.all');
});

Route::get('/bulletin/{id}', function () {
    return view('bulletin.single');
});

Route::get('/a/login', function () {
   return view('admin.login');
})->middleware('admin-logged');

Route::post('/a/login', 'AdminController@login')->name('admin.login');

Route::group(['middleware' => ['admin-not-logged']], function () {

    Route::get('/a/logout', 'AdminController@logout');

    Route::get('/a/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/a/users', function () {
        return view('admin.all-users');
    });

    Route::get('/a/user/{id}', function () {
        return view('admin.single-user');
    });

    Route::get('/a/products', function () {
        return view('admin.all-products');
    });

    Route::get('/a/product/add', function () {
        return view('admin.add-product');
    });

    Route::get('/a/product/{id}', function () {
        return view('admin.single-product');
    });

    Route::get('/a/product/{id}/edit', function () {
        return view('admin.edit-product');
    });

    Route::get('/a/product/delete', function () {
        return redirect('/a/products');
    });

    Route::get('/a/bulletins', function () {
        return view('admin.all-bulletins');
    });

    Route::get('/a/bulletin/add', function () {
        return view('admin.add-bulletin');
    });

    Route::get('/a/bulletin/{id}', function () {
        return view('admin.single-bulletin');
    });

    Route::get('/a/bulletin/{id}/edit', function () {
        return view('admin.edit-bulletin');
    });

    Route::get('/a/bulletin/delete', function () {
        return redirect('/a/bulletins');
    });

    Route::get('/a/settings', function () {
        return view('admin.settings');
    });

});