<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Spbd View
        View::composer(
            ['admins.contents.ordering.spbd.spbdList', 'admins.contents.ordering.spbd.spbdForm'], 
            'App\ViewComposers\ordering\SpbdComposer'
        );
        
        // Receipt View
        View::composer(
            ['admins.contents.ordering.receipt.receiptList', 'admins.contents.ordering.receipt.receiptForm'], 
            'App\ViewComposers\ordering\ReceiptComposer'
        );
    }
}
