<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    // SPBD
    Route::controller(Admins\Ordering\SpbdController::class)->group(function (){
        Route::get('/spbd', 'index')->name('spbd.index');    
        Route::get('/spbd/form/{id}', 'transfer_branch_form')->name('spbd.form');    
        // Route::post('/spbd', 'store')->name('spbd.store');        
        // Route::patch('spbd/{id}', 'update')->name('spbd.update');
        // Route::delete('/spbd/{id}', 'destroy')->name('spbd.delete');
        // Route::get('record/spbd', 'record')->name('spbd.record');
        // Route::get('/spbd/{id}/request', 'request')->name('spbd.request');
        // Route::get('/spbd/{id}/verify1', 'verify1')->name('spbd.verify1');
        // Route::get('/spbd/{id}/verify2', 'verify2')->name('spbd.verify2');
        // Route::get('/spbd/{id}/approve', 'approve')->name('spbd.approve');
        // Route::get('search/spbd', 'searchTransferBranch')->name('spbd.search');

        // // Detail SPBD
        // Route::post('spbd/detail/{id}', 'store_detail')->name('spbd.store.detail');
        // Route::get('spbd/detail/{id}', 'edit_detail')->name('spbd.edit.detail');
        // Route::patch('spbd/detail/{id}', 'update_detail')->name('spbd.update.detail');
        // Route::delete('/spbd/detail/{id}', 'destroy_detail')->name('spbd.delete.detail');
        // Route::get('record/spbd/{id}', 'record_detail')->name('spbd.record.detail');
    });
    
});