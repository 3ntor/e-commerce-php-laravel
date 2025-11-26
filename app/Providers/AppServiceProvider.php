<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Service;
use App\Models\Offer;

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
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        view()->composer('website.partials.*', function ($view) {
        $view->with('services', Service::where('is_active', true)->orderBy('order')->get());
        $view->with('offers', Offer::where('is_active', true)->orderBy('order')->take(2)->get());
    });
    }

}
