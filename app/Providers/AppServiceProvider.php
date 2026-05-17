<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request; // <-- PASTIKAN BARIS INI ADA DI ATAS

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
        // 1. Paksa Laravel mempercayai semua load balancer/proxy dari Vercel
        Request::someTrustProxyMethodAtRuntime(); // Laravel 11/12 otomatis handle via middleware, tapi baris di bawah ini adalah kuncinya:

        if (config('app.env') === 'production' || env('APP_ENV') === 'production') {
            // 2. Paksa skema URL generasi aset ke HTTPS
            URL::forceScheme('https');
        }
    }
}
