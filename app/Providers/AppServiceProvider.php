<?php

namespace App\Providers;

use App\Models\Tenant;
use App\Observers\TenantObserver;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        /** declarando os observers */
        Tenant::observe(TenantObserver::class);
    }
}
