<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {

    // Admin
    Route::get('/admin', 'Admins\AdminController@index')->name('admin.user.index');    
    Route::post('/admin', 'Admins\AdminController@store')->name('admin.store');
    Route::patch('/admin/{id}', 'Admins\AdminController@update')->name('admin.update');
    Route::get('/admin/{id}/edit', 'Admins\AdminController@edit')->name('admin.edit');
    Route::delete('/admin/{id}', 'Admins\AdminController@destroy')->name('admin.delete');
    Route::get('record/admin', 'Admins\AdminController@recordAdmin')->name('record.admin');

    Route::get('/admin/profile', 'Admins\Tools\AdminController@profile')->name('admin.profile');
    Route::patch('/admin/profile/{id}', 'Admins\Tools\AdminController@update_profile')->name('profile.update');

    // Role
    Route::get('/role', 'Admins\RoleController@index')->name('role.index');
    Route::post('/role', 'Admins\RoleController@store')->name('role.store');
    Route::patch('/role/{id}', 'Admins\RoleController@update')->name('role.update');
    Route::get('/role/{id}/edit', 'Admins\RoleController@edit')->name('role.edit');
    Route::get('/role/{id}/show', 'Admins\RoleController@show')->name('role.show');
    Route::delete('/role/{id}', 'Admins\RoleController@destroy')->name('role.delete');
    Route::get('record/role', 'Admins\RoleController@recordRole')->name('record.role');
    Route::post('/rolePermission','Admins\RoleController@updatePermission')->name('update.rolePermission');

    // Permission
    Route::get('/permission', 'Admins\PermissionController@index')->name('permission.index');
    Route::post('/permission', 'Admins\PermissionController@store')->name('permission.store');
    Route::patch('/permission/{id}', 'Admins\PermissionController@update')->name('permission.update');
    Route::get('/permission/{id}/edit', 'Admins\PermissionController@edit')->name('permission.edit');
    Route::delete('/permission/{id}', 'Admins\PermissionController@destroy')->name('permission.delete');
    Route::get('record/permission', 'Admins\PermissionController@recordPermission')->name('record.permission');

    // Branch
    Route::get('/branch', 'Admins\Tools\BranchController@index')->name('branch.index');    
    Route::post('/branch', 'Admins\Tools\BranchController@store')->name('branch.store');
    Route::patch('/branch/{id}', 'Admins\Tools\BranchController@update')->name('branch.update');
    Route::get('/branch/{id}/edit', 'Admins\Tools\BranchController@edit')->name('branch.edit');
    Route::delete('/branch/{id}', 'Admins\Tools\BranchController@destroy')->name('branch.delete');
    Route::get('record/branch', 'Admins\Tools\BranchController@record')->name('branch.record');

});