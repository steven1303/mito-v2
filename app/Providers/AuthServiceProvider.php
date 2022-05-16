<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        // Admin
        Gate::define('admin.view', 'App\Policies\Tools\AdminPolicy@view');
        Gate::define('admin.store', 'App\Policies\Tools\AdminPolicy@store');
        Gate::define('admin.update', 'App\Policies\Tools\AdminPolicy@update');
        Gate::define('admin.delete', 'App\Policies\Tools\AdminPolicy@delete');
        Gate::define('admin.profile', 'App\Policies\Tools\AdminPolicy@profile');
        Gate::define('admin.branch', 'App\Policies\Tools\AdminPolicy@branch');
        // Permission
        Gate::define('permission.view', 'App\Policies\Tools\PermissionPolicy@view');
        Gate::define('permission.store', 'App\Policies\Tools\PermissionPolicy@store');
        Gate::define('permission.update', 'App\Policies\Tools\PermissionPolicy@update');
        Gate::define('permission.delete', 'App\Policies\Tools\PermissionPolicy@delete');
        // Rule
        Gate::define('role.view', 'App\Policies\Tools\RolePolicy@view');
        Gate::define('role.store', 'App\Policies\Tools\RolePolicy@store');
        Gate::define('role.update', 'App\Policies\Tools\RolePolicy@update');
        Gate::define('role.delete', 'App\Policies\Tools\RolePolicy@delete');
        Gate::define('role.permission', 'App\Policies\Tools\RolePolicy@rolePermission');
        // Branch
        Gate::define('branch.view', 'App\Policies\Tools\BranchPolicy@view');
        Gate::define('branch.store', 'App\Policies\Tools\BranchPolicy@store');
        Gate::define('branch.update', 'App\Policies\Tools\BranchPolicy@update');
        Gate::define('branch.delete', 'App\Policies\Tools\BranchPolicy@delete');

        // Tax
        Gate::define('tax.view', 'App\Policies\Settings\TaxPolicy@view');
        Gate::define('tax.store', 'App\Policies\Settings\TaxPolicy@store');
        Gate::define('tax.update', 'App\Policies\Settings\TaxPolicy@update');
        Gate::define('tax.delete', 'App\Policies\Settings\TaxPolicy@delete');

        // Customer
        Gate::define('customer.view', 'App\Policies\Settings\CustomerPolicy@view');
        Gate::define('customer.store', 'App\Policies\Settings\CustomerPolicy@store');
        Gate::define('customer.update', 'App\Policies\Settings\CustomerPolicy@update');
        Gate::define('customer.delete', 'App\Policies\Settings\CustomerPolicy@delete');
        Gate::define('customer.info', 'App\Policies\Settings\CustomerPolicy@info');

        // Vendor
        Gate::define('vendor.view', 'App\Policies\Settings\VendorPolicy@view');
        Gate::define('vendor.store', 'App\Policies\Settings\VendorPolicy@store');
        Gate::define('vendor.update', 'App\Policies\Settings\VendorPolicy@update');
        Gate::define('vendor.delete', 'App\Policies\Settings\VendorPolicy@delete');
        Gate::define('vendor.info', 'App\Policies\Settings\VendorPolicy@info');

        // Stock Master
        Gate::define('stock.master.view', 'App\Policies\Inventory\StockMasterPolicy@view');
        Gate::define('stock.master.store', 'App\Policies\Inventory\StockMasterPolicy@store');
        Gate::define('stock.master.update', 'App\Policies\Inventory\StockMasterPolicy@update');
        Gate::define('stock.master.delete', 'App\Policies\Inventory\StockMasterPolicy@delete');
        Gate::define('stock.master.movement', 'App\Policies\Inventory\StockMasterPolicy@movement');
    }
}
