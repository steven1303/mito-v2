<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    // Auth
    Route::get('login', 'Admins\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admins\LoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Admins\LoginController@logout')->name('admin.logout');
    Route::get('/', 'Admins\DashboardController@index')->name('admin.home');
    Route::get('/dashboard', 'Admins\DashboardController@dashboard')->name('admin.dashboard');

    Route::controller(Admins\Settings\CustomerController::class)->group(function (){
        Route::get('/customer', 'index')->name('customer.index');
        Route::post('/customer', 'store')->name('customer.store');
        Route::patch('/customer/{id}', 'update')->name('customer.update');
        Route::get('/customer/{id}/edit', 'edit')->name('customer.edit');
        Route::delete('/customer/{id}', 'destroy')->name('customer.delete');
        Route::get('record/customer', 'record')->name('customer.record');
        Route::get('/customer/{id}/info', 'info')->name('customer.info');
        // Route::get('record/search_customer', 'Admins\Settings\CustomerController@searchCustomer')->name('search.customer');
        // Route::get('/customer/{id}/invoice', 'Admins\Settings\CustomerController@invoice')->name('customer.inv');
    });

    Route::controller(Admins\Settings\VendorController::class)->group(function (){
        Route::get('/vendor', 'index')->name('vendor.index');
        Route::post('/vendor', 'store')->name('vendor.store');
        Route::patch('/vendor/{id}', 'update')->name('vendor.update');
        Route::get('/vendor/{id}/edit', 'edit')->name('vendor.edit');
        Route::delete('/vendor/{id}', 'destroy')->name('vendor.delete');
        Route::get('record/vendor', 'record')->name('vendor.record');
        Route::get('/vendor/{id}/info', 'info')->name('vendor.info');
        Route::get('/serch/vendor', 'searchVendor')->name('vendor.search');
        // Route::get('/vendor/{id}/po_stock', 'po_stock')->name('vendor.po_stock');
    });

    


    // Image
    Route::match(['get', 'post'], 'post-image-upload', 'Admins\ImageController@postImage');
	Route::delete('post-remove-image/{filename}', 'Admins\ImageController@deletePostImage');





});