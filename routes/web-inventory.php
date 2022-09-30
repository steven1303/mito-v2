<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {

    // Stock Master
    Route::controller(Admins\Inventory\StockMasterController::class)->group(function (){
        Route::get('/stock_master', 'index')->name('stock_master.index');    
        Route::post('/stock_master', 'store')->name('stock_master.store');
        Route::patch('/stock_master/{id}', 'update')->name('stock_master.update');
        Route::get('/stock_master/{id}/edit', 'edit')->name('stock_master.edit');
        Route::delete('/stock_master/{id}', 'destroy')->name('stock_master.delete');
        Route::get('record/stock_master', 'record')->name('stock_master.record');
        Route::get('search/stock_master', 'searchStockMaster')->name('stock_master.search');
    });

    // Adjustment
    Route::controller(Admins\Inventory\AdjustmentController::class)->group(function (){
        Route::get('/adj', 'index')->name('adj.index');    
        Route::get('/adj/form/{id}', 'create_adjustment_form')->name('adj.form');    
        Route::post('/adj', 'store')->name('adj.store');
        Route::patch('/adj/open/{id}', 'open')->name('adj.open');
        // Route::get('/adj/{id}/edit', 'edit')->name('adj.edit');
        Route::delete('/adj/{id}', 'destroy')->name('adj.delete');
        Route::get('record/adj', 'record')->name('adj.record');

        // Detail Adjustment
        Route::post('adj/detail/{id}', 'store_detail')->name('adj.store.detail');
        Route::get('adj/detail/{id}', 'edit_detail')->name('adj.edit.detail');
        Route::patch('adj/detail/{id}', 'update_detail')->name('adj.update.detail');
        Route::delete('/adj/detail/{id}', 'destroy_detail')->name('adj.delete.detail');
        Route::get('record/adj/{id}', 'record_detail')->name('adj.record.detail');
    });    
});