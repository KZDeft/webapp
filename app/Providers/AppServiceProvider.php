<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

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
        Paginator::useBootstrap();
        view()->composer('*', function ($view) {
            $order_0 = DB::table('tbl_order')->where('order_status', '=', '0')->count();
            $order_1 = DB::table('tbl_order')->where('order_status', '=', '1')->count();
            $order_2 = DB::table('tbl_order')->where('order_status', '=', '2')->count();
            $order_3 = DB::table('tbl_order')->where('order_status', '=', '3')->count();


            $view->with(compact('order_0', 'order_1', 'order_2', 'order_3'));
        });
    }
}
