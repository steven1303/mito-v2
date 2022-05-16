<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {

    // Post
    Route::get('/post', 'Admins\Website\PostController@index')->name('admin.website.post.index');
    Route::get('/post_detail', 'Admins\Website\PostController@detail')->name('admin.website.post.detail');
    Route::post('/post', 'Admins\Website\PostController@store')->name('admin.website.post.store');
    Route::get('/post_detail/{id}/edit', 'Admins\Website\PostController@detail')->name('admin.website.post.edit');
    Route::patch('/post_detail/{id}', 'Admins\Website\PostController@update')->name('admin.website.post.update');
    // Route::delete('/admin/{id}', 'Admins\AdminController@destroy')->name('admin.delete');
    Route::get('record/post', 'Admins\Website\PostController@recordPost')->name('record.website.post');


});