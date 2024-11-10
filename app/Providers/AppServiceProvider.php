<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // if(request()->getHost() === 'https://0bf7-103-225-244-72.ngrok-free.app') {
        //     URL::forceScheme('https');
        //     config(['app.url' => 'https://0bf7-103-225-244-72.ngrok-free.app']);
        // }
    }
}
