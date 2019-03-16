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

Route::get('/u/register', 'UserController@getRegistrationForm')->name('user.register');

Route::post('/u/register', 'UserController@register')->name('user.register');

Route::group(['middleware' => ['user-not-logged']], function () {

    Route::get('/u/login', function () {
        return view('user.login');
    })->middleware('user-not-logged');

    Route::post('/u/login', 'UserController@login')->name('user.login');

});

Route::group(['middleware' => ['user-logged']], function () {

    Route::get('/u/logout', 'UserController@logout');

    Route::get('/u/dashboard', function () {
        return view('user.dashboard');
    });

    Route::get('/u/tree', 'UserController@tree');

    Route::get('/u/ref-link', 'UserController@getRefLinks')->name('user.ref-link');

    Route::post('/u/ref-link', 'UserController@generateRefLink')->name('user.ref-link');

    Route::get('/u/account', 'UserController@getPoints');

    Route::post('/u/account/transfer', 'UserController@transferPoints');

    Route::post('/u/account/req', 'UserController@requestPoints');

    Route::post('/u/account/withdraw', 'UserController@requestWithdrawal');

    Route::get('/u/buy/product/{id}', 'ProductController@getProductBuyPage')->name('product.buy');

    Route::post('/u/buy/product/{id}', 'ProductController@buyProduct');

    Route::get('/u/settings', function () {
        return view('user.settings');
    });

});



Route::get('/products', 'ProductController@userAllProducts');

Route::get('/product/{id}', function () {
    return view('product.single');
});

Route::get('/bulletins', 'BulletinController@userAllBulletins');

Route::get('/bulletin/{id}', 'BulletinController@userSingleBulletin');

Route::get('/a/login', function () {
   return view('admin.login');
})->middleware('admin-not-logged');

Route::post('/a/login', 'AdminController@login')->name('admin.login');

Route::group(['middleware' => ['admin-logged']], function () {

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

    Route::get('/a/products', 'ProductController@adminAllProducts');

    Route::get('/a/product/add', function () {
        return view('admin.add-product');
    });

    Route::post('/a/product/add', 'ProductController@add')->name('admin.add-product');

    Route::get('/a/product/{id}', function () {
        return view('admin.single-product');
    });

    Route::get('/a/product/{id}/edit', 'ProductController@getProduct')->name('admin.edit-product');

    Route::put('/a/product/{id}/edit', 'ProductController@edit')->name('admin.edit-product');

    Route::delete('/a/product/delete', 'ProductController@delete')->name('admin.delete-product');

    Route::get('/a/bulletins', 'BulletinController@adminAllBulletins');

    Route::get('/a/bulletin/add', function () {
        return view('admin.add-bulletin');
    });

    Route::post('/a/bulletin/add', 'BulletinController@addBulletin')->name('admin.add-bulletin');

    Route::get('/a/bulletin/{id}', 'BulletinController@adminSingleBulletin');

    Route::get('/a/bulletin/{id}/edit', 'BulletinController@getBulletin')->name('admin.edit-bulletin');

    Route::put('/a/bulletin/{id}/edit', 'BulletinController@editBulletin')->name('admin.edit-bulletin');

    Route::delete('/a/bulletin/delete', 'BulletinController@deleteBulletin')->name('admin.delete-bulletin');

    Route::get('/a/point-requests', 'AdminController@getPointRequests');

    Route::post('/a/point-requests', 'AdminController@responsePointRequest');

    Route::get('/a/withdraw-requests', 'AdminController@getWithdrawRequests');

    Route::post('/a/withdraw-requests', 'AdminController@responseWithdrawRequest');

    Route::get('/a/settings', function () {
        return view('admin.settings');
    });

});