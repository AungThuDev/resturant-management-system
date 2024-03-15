<?php

namespace App\Providers;

use App\Models\CustomerDiscount;
use App\Models\Discount;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        $discounts = Discount::all();
        $customer_discounts = CustomerDiscount::all();
        $combined_discounts = array_merge($discounts->toArray(), $customer_discounts->toArray());
        View::share('combined_discounts', $combined_discounts);
        View::share('setting', Setting::find(1));
    }
}
