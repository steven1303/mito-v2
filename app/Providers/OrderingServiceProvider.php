<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class OrderingServiceProvider extends ServiceProvider
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
        // Spbd
        Gate::define('spbd.view', 'App\Policies\Ordering\SpbdPolicy@view');
        Gate::define('spbd.store', 'App\Policies\Ordering\SpbdPolicy@store');
        Gate::define('spbd.update', 'App\Policies\Ordering\SpbdPolicy@update');
        Gate::define('spbd.delete', 'App\Policies\Ordering\SpbdPolicy@delete');
        Gate::define('spbd.request', 'App\Policies\Ordering\SpbdPolicy@request');
        Gate::define('spbd.verify', 'App\Policies\Ordering\SpbdPolicy@verify');
        Gate::define('spbd.approve', 'App\Policies\Ordering\SpbdPolicy@approve');
        Gate::define('spbd.print', 'App\Policies\Ordering\SpbdPolicy@print');
    }
}
