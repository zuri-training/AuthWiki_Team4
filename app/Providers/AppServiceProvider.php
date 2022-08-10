<?php

namespace App\Providers;

use Illuminate\{
    Pagination\Paginator,
    Support\ServiceProvider
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    
        public function register()
        {
            app()->register(\SocialiteProviders\Manager\ServiceProvider::class);
        }
    

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
