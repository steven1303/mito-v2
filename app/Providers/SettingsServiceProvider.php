<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class SettingsServiceProvider extends ServiceProvider
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
    }
}
