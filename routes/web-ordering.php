<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    // SPBD
    Route::controller(Admins\Ordering\SpbdController::class)->group(function (){
        Route::get('/spbd', 'index')->name('spbd.index');    
        Route::get('/spbd/form/{id}', 'spbd_form')->name('spbd.form');    
        Route::post('/spbd', 'store')->name('spbd.store');     
        // Route::patch('spbd/{id}', 'update')->name('spbd.update');
        Route::delete('/spbd/{id}', 'destroy')->name('spbd.delete');
        Route::get('record/spbd', 'record')->name('spbd.record');
        Route::get('/spbd/{id}/request', 'request')->name('spbd.request');
        Route::get('/spbd/{id}/verify', 'verify')->name('spbd.verify');
        Route::get('/spbd/{id}/approve', 'approve')->name('spbd.approve');
        Route::get('search/spbd', 'search')->name('spbd.search');

        // Detail SPBD
        Route::post('spbd/detail/{id}', 'store_detail')->name('spbd.store.detail');
        Route::get('spbd/detail/{id}', 'edit_detail')->name('spbd.edit.detail');
        Route::patch('spbd/detail/{id}', 'update_detail')->name('spbd.update.detail');
        Route::delete('/spbd/detail/{id}', 'destroy_detail')->name('spbd.delete.detail');
        Route::get('record/spbd/{id}/{status?}', 'record_detail')->name('spbd.record.detail');
    });

    // SPBD
    Route::controller(Admins\Ordering\PoStockController::class)->group(function (){
        Route::get('/po_stock', 'index')->name('po.stock.index');    
        Route::get('/po_stock/form/{id}', 'po_stock_form')->name('po.stock.form');    
        Route::post('/po_stock', 'store')->name('po.stock.store');     
        // Route::patch('po_stock/{id}', 'update')->name('po.stock.update');
        // Route::delete('/po_stock/{id}', 'destroy')->name('po.stock.delete');
        Route::get('record/po_stock', 'record')->name('po.stock.record');
        // Route::get('/po_stock/{id}/request', 'request')->name('po.stock.request');
        // Route::get('/po_stock/{id}/verify', 'verify')->name('po.stock.verify');
        // Route::get('/po_stock/{id}/approve', 'approve')->name('po.stock.approve');
        // Route::get('search/po_stock', 'searchTransferBranch')->name('po.stock.search');

        // Detail PoStock
        Route::post('po_stock/detail/{id}', 'store_detail')->name('po.stock.store.detail');
        // Route::get('po_stock/detail/{id}', 'edit_detail')->name('po.stock.edit.detail');
        // Route::patch('po_stock/detail/{id}', 'update_detail')->name('po.stock.update.detail');
        // Route::delete('/po_stock/detail/{id}', 'destroy_detail')->name('po.stock.delete.detail');
        Route::get('record/po_stock/{id}/{status?}', 'record_detail')->name('po.stock.record.detail');
    });
    
});