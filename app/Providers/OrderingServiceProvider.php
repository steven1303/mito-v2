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

        // PoStock
        Gate::define('po.stock.view', 'App\Policies\Ordering\PoStockPolicy@view');
        Gate::define('po.stock.store', 'App\Policies\Ordering\PoStockPolicy@store');
        Gate::define('po.stock.update', 'App\Policies\Ordering\PoStockPolicy@update');
        Gate::define('po.stock.delete', 'App\Policies\Ordering\PoStockPolicy@delete');
        Gate::define('po.stock.request', 'App\Policies\Ordering\PoStockPolicy@request');
        Gate::define('po.stock.verify1', 'App\Policies\Ordering\PoStockPolicy@verify1');
        Gate::define('po.stock.verify2', 'App\Policies\Ordering\PoStockPolicy@verify2');
        Gate::define('po.stock.approve', 'App\Policies\Ordering\PoStockPolicy@approve');
        Gate::define('po.stock.print', 'App\Policies\Ordering\PoStockPolicy@print');
    }
}
