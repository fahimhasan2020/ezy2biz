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

Route::get('/', 'LandingPageController@home');

Route::get('/register', 'UserController@getRegistrationForm')->name('user.register');

Route::post('/register', 'UserController@register')->name('user.register');

Route::group(['middleware' => ['user-not-logged']], function () {

    Route::post('/u/login', 'UserController@login')->name('user.login');

});

Route::group(['middleware' => ['user-logged']], function () {

    Route::get('/u/logout', 'UserController@logout');

    Route::get('/u/tree', 'UserController@tree');

    Route::get('/u/ref-link', 'UserController@getRefLinks')->name('user.ref-link');

    Route::post('/u/ref-link', 'UserController@generateRefLink')->name('user.ref-link');

    Route::get('/u/account', 'UserController@getAccount');

    Route::get('/u/account/edit', 'UserController@getEditAccountPage');

    Route::put('/u/account/edit', 'UserController@editAccount');

    Route::post('/u/account/transfer', 'UserController@transferPoints');

    Route::post('/u/account/req', 'UserController@requestPoints');

    Route::post('/u/account/withdraw', 'UserController@requestWithdrawal');

    Route::get('/u/buy/product/{id}', 'ProductController@getProductBuyPage')->name('product.buy');

    Route::post('/u/buy/product/{id}', 'ProductController@buyProduct');

    Route::get('/u/commission-history', 'UserController@commissionHistory');

    Route::get('/u/settings', 'UserController@getSettings');

    Route::put('/u/settings', 'UserController@editSettings');

});

Route::get('/u/{any}', function () {
    return redirect('/u/account');
});

Route::get('/u', function () {
    return redirect('/u/account');
});

Route::get('/products', 'ProductController@userAllProducts');

Route::get('/product/{id}', 'ProductController@singleProduct');


Route::get('/bulletins', 'BulletinController@userAllBulletins');

Route::get('/bulletin/{id}', 'BulletinController@userSingleBulletin');


Route::get('/a/login', function () {
   return view('admin.login');
})->middleware('admin-not-logged');
Route::post('/a/login', 'AdminController@login')->name('admin.login');
Route::group(['middleware' => ['admin-logged']], function () {

    Route::get('/a/logout', 'AdminController@logout');

    Route::get('/a/dashboard', 'AdminController@dashboard');

    Route::post('/a/dashboard', 'AdminController@addSlideImages');

    Route::delete('/a/dashboard', 'AdminController@deleteSlideImage');

    Route::get('/a/users', 'AdminController@showAllUsers');

    Route::get('/a/user/{id}', 'AdminController@getUser');

    Route::get('/a/user/{id}/edit', 'AdminController@getUserEditForm');

    Route::put('/a/user/{id}', 'AdminController@editUser');

    Route::delete('/a/user/delete', 'AdminController@deleteUser');

    Route::get('/a/products', 'ProductController@adminAllProducts');

    Route::get('/a/product/add', function () {
        return view('admin.add-product');
    });

    Route::post('/a/product/add', 'ProductController@add')->name('admin.add-product');

    Route::get('/a/product/{id}/edit', 'ProductController@getProduct')->name('admin.edit-product');

    Route::put('/a/product/{id}', 'ProductController@edit')->name('admin.edit-product');

    Route::delete('/a/product/delete', 'ProductController@delete')->name('admin.delete-product');

    Route::get('/a/bulletins', 'BulletinController@adminAllBulletins');

    Route::get('/a/bulletin/add', function () {
        return view('admin.add-bulletin');
    });

    Route::post('/a/bulletin/add', 'BulletinController@addBulletin')->name('admin.add-bulletin');

    Route::get('/a/bulletin/{id}/edit', 'BulletinController@getBulletin')->name('admin.edit-bulletin');

    Route::put('/a/bulletin/{id}', 'BulletinController@editBulletin')->name('admin.edit-bulletin');

    Route::delete('/a/bulletin/delete', 'BulletinController@deleteBulletin')->name('admin.delete-bulletin');

    Route::get('/a/point-requests', 'AdminController@getPointRequests');

    Route::post('/a/point-requests', 'AdminController@responsePointRequest');

    Route::get('/a/withdraw-requests', 'AdminController@getWithdrawRequests');

    Route::post('/a/withdraw-requests', 'AdminController@responseWithdrawRequest');

    Route::get('/a/withdraw-requests/history', 'AdminController@getWithdrawHistory');

    Route::get('/a/product-orders', 'AdminController@getProductOrders');

    Route::post('/a/product-orders', 'AdminController@responseProductOrders');

    Route::get('/a/settings', 'AdminController@getSettings');

    Route::put('/a/settings', 'AdminController@editSettings');

    Route::get('/a/account', 'AdminController@getAccount');

    Route::post('/a/account/profile', 'AdminController@editProfile');

    Route::post('/a/account/bkash', 'AdminController@editBkash');

    Route::post('/a/account/rocket', 'AdminController@editRocket');

});

Route::get('/a/{any}', function () {
    return redirect('/a/dashboard');
});

Route::get('/a', function () {
    return redirect('/a/dashboard');
});