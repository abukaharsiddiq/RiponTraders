<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\CustomerGroup;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('product_groups',ProductGroup::latest()->get()); 
        View::share('customer_groups',CustomerGroup::latest()->get()); 
        View::share('products',Product::latest()->get()); 
        View::share('setting',Setting::latest()->first()); 
    }
}
