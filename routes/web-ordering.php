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
        Route::get('/spbd/{id}/verify1', 'verify1')->name('spbd.verify1');
        Route::get('/spbd/{id}/verify2', 'verify2')->name('spbd.verify2');
        Route::get('/spbd/{id}/approve', 'approve')->name('spbd.approve');
        Route::get('/spbd/{id}/reject', 'reject')->name('spbd.reject');
        Route::get('search/spbd', 'search')->name('spbd.search');

        // Detail SPBD
        Route::post('spbd/detail/{id}', 'store_detail')->name('spbd.store.detail');
        Route::get('spbd/detail/{id}', 'edit_detail')->name('spbd.edit.detail');
        Route::patch('spbd/detail/{id}', 'update_detail')->name('spbd.update.detail');
        Route::delete('/spbd/detail/{id}', 'destroy_detail')->name('spbd.delete.detail');
        Route::get('record/spbd/{id}/{status?}', 'record_detail')->name('spbd.record.detail');
    });

    // PO Stock
    Route::controller(Admins\Ordering\PoStockController::class)->group(function (){
        Route::get('/po_stock', 'index')->name('po.stock.index');    
        Route::get('/po_stock/form/{id}', 'po_stock_form')->name('po.stock.form');    
        Route::post('/po_stock', 'store')->name('po.stock.store');     
        Route::patch('po_stock/{id}', 'update')->name('po.stock.update');
        Route::delete('/po_stock/{id}', 'destroy')->name('po.stock.delete');
        Route::get('record/po_stock', 'record')->name('po.stock.record');
        Route::get('/po_stock/{id}/request', 'request')->name('po.stock.request');
        Route::get('/po_stock/{id}/verify1', 'verify1')->name('po.stock.verify1');
        Route::get('/po_stock/{id}/verify2', 'verify2')->name('po.stock.verify2');
        Route::get('/po_stock/{id}/approve', 'approve')->name('po.stock.approve');
        Route::get('search/po_stock', 'search')->name('po.stock.search');

        // Detail PoStock
        Route::post('po_stock/detail/{id}', 'store_detail')->name('po.stock.store.detail');
        Route::get('po_stock/detail/{id}', 'edit_detail')->name('po.stock.edit.detail');
        Route::patch('po_stock/detail/{id}', 'update_detail')->name('po.stock.update.detail');
        Route::delete('/po_stock/detail/{id}', 'destroy_detail')->name('po.stock.delete.detail');
        Route::get('record/po_stock/{id}/{status?}', 'record_detail')->name('po.stock.record.detail');
    });

    // Receipt
    Route::controller(Admins\Ordering\ReceiptController::class)->group(function (){
        Route::get('/rec_stock', 'index')->name('rec.stock.index');    
        Route::get('/rec_stock/form/{id}', 'rec_stock_form')->name('rec.stock.form');    
        Route::post('/rec_stock', 'store')->name('rec.stock.store');     
        Route::patch('rec_stock/{id}', 'update')->name('rec.stock.update');
        Route::delete('/rec_stock/{id}', 'destroy')->name('rec.stock.delete');
        Route::get('record/rec_stock', 'record')->name('rec.stock.record');
        // Route::get('/rec_stock/{id}/approve', 'approve')->name('rec.stock.approve');

        // Detail Receipt
        // Route::post('rec_stock/detail/{id}', 'store_detail')->name('rec.stock.store.detail');
        Route::get('rec_stock/detail/{id}', 'edit_detail')->name('rec.stock.edit.detail');
        // Route::patch('rec_stock/detail/{id}', 'update_detail')->name('rec.stock.update.detail');
        // Route::delete('/rec_stock/detail/{id}', 'destroy_detail')->name('rec.stock.delete.detail');
        Route::get('record/rec_stock/{id}/{status?}', 'record_detail')->name('rec.stock.record.detail');
    });
    
});