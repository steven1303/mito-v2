<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class InventoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Stock Master
        Gate::define('stock.master.view', 'App\Policies\Inventory\StockMasterPolicy@view');
        Gate::define('stock.master.store', 'App\Policies\Inventory\StockMasterPolicy@store');
        Gate::define('stock.master.update', 'App\Policies\Inventory\StockMasterPolicy@update');
        Gate::define('stock.master.delete', 'App\Policies\Inventory\StockMasterPolicy@delete');
        Gate::define('stock.master.movement', 'App\Policies\Inventory\StockMasterPolicy@movement');

        // Adjustment
        Gate::define('adjustment.view', 'App\Policies\Inventory\AdjustmentPolicy@view');
        Gate::define('adjustment.store', 'App\Policies\Inventory\AdjustmentPolicy@store');
        Gate::define('adjustment.update', 'App\Policies\Inventory\AdjustmentPolicy@update');
        Gate::define('adjustment.delete', 'App\Policies\Inventory\AdjustmentPolicy@delete');
        Gate::define('adjustment.request', 'App\Policies\Inventory\AdjustmentPolicy@request');
        Gate::define('adjustment.approve', 'App\Policies\Inventory\AdjustmentPolicy@approve');
        Gate::define('adjustment.print', 'App\Policies\Inventory\AdjustmentPolicy@print');

        // Transfer Branch
        Gate::define('transfer.branch.view', 'App\Policies\Inventory\TransferBranchPolicy@view');
        Gate::define('transfer.branch.store', 'App\Policies\Inventory\TransferBranchPolicy@store');
        Gate::define('transfer.branch.update', 'App\Policies\Inventory\TransferBranchPolicy@update');
        Gate::define('transfer.branch.delete', 'App\Policies\Inventory\TransferBranchPolicy@delete');
        Gate::define('transfer.branch.request', 'App\Policies\Inventory\TransferBranchPolicy@request');
        Gate::define('transfer.branch.approve', 'App\Policies\Inventory\TransferBranchPolicy@approve');
        Gate::define('transfer.branch.print', 'App\Policies\Inventory\TransferBranchPolicy@print');
    }
}
