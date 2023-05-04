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
        View::composer('backend/components/_page_sidebar', 'App\Http\Composers\BackendMenuComposer');
        View::composer('frontend/layouts/header', 'App\Http\Composers\FrontendHeaderComposer');
    }
}
