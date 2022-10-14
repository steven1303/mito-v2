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

    // Stock Movement
    Route::controller(Admins\Inventory\StockMovementController::class)->group(function (){
        Route::get('/stockmovement/{id}', 'index')->name('stock_master.movement');  
        Route::get('/record/stockmovement/{id}', 'record')->name('stock_master.movement.record');  
    });

    // Adjustment
    Route::controller(Admins\Inventory\AdjustmentController::class)->group(function (){
        Route::get('/adj', 'index')->name('adj.index');    
        Route::get('/adj/form/{id}', 'create_adjustment_form')->name('adj.form');    
        Route::post('/adj', 'store')->name('adj.store');
        Route::delete('/adj/{id}', 'destroy')->name('adj.delete');
        Route::get('record/adj', 'record')->name('adj.record');
        Route::get('/adj/{id}/request', 'request')->name('adj.request');
        Route::get('/adj/{id}/approve', 'approve')->name('adj.approve');

        // Detail Adjustment
        Route::post('adj/detail/{id}', 'store_detail')->name('adj.store.detail');
        Route::get('adj/detail/{id}', 'edit_detail')->name('adj.edit.detail');
        Route::patch('adj/detail/{id}', 'update_detail')->name('adj.update.detail');
        Route::delete('/adj/detail/{id}', 'destroy_detail')->name('adj.delete.detail');
        Route::get('record/adj/{id}', 'record_detail')->name('adj.record.detail');
    });
    
    // Transfer Branch
    Route::controller(Admins\Inventory\TransferBranchController::class)->group(function (){
        Route::get('/transfer_branch', 'index')->name('transfer.branch.index');    
        Route::get('/transfer_branch/form/{id}', 'transfer_branch_form')->name('transfer.branch.form');    
        Route::post('/transfer_branch', 'store')->name('transfer.branch.store');        
        Route::patch('transfer_branch/{id}', 'update')->name('transfer.branch.update');
        Route::delete('/transfer_branch/{id}', 'destroy')->name('transfer.branch.delete');
        Route::get('record/transfer_branch', 'record')->name('transfer.branch.record');
        Route::get('/transfer_branch/{id}/request', 'request')->name('transfer.branch.request');
        Route::get('/transfer_branch/{id}/approve', 'approve')->name('transfer.branch.approve');

        // Detail Transfer Branch
        Route::post('transfer_branch/detail/{id}', 'store_detail')->name('transfer.branch.store.detail');
        Route::get('transfer_branch/detail/{id}', 'edit_detail')->name('transfer.branch.edit.detail');
        Route::patch('transfer_branch/detail/{id}', 'update_detail')->name('transfer.branch.update.detail');
        Route::delete('/transfer_branch/detail/{id}', 'destroy_detail')->name('transfer.branch.delete.detail');
        Route::get('record/transfer_branch/{id}', 'record_detail')->name('transfer.branch.record.detail');
    });
});