<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {

    // Tax
    Route::controller(Admins\Inventory\StockMasterController::class)->group(function (){
        Route::get('/stock_master', 'index')->name('stock_master.index');    
        Route::post('/stock_master', 'store')->name('stock_master.store');
        Route::patch('/stock_master/{id}', 'update')->name('stock_master.update');
        Route::get('/stock_master/{id}/edit', 'edit')->name('stock_master.edit');
        Route::delete('/stock_master/{id}', 'destroy')->name('stock_master.delete');
        Route::get('record/stock_master', 'record')->name('stock_master.record');
    });

    
});