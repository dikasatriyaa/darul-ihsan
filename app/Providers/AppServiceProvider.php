<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Jika berjalan di server produksi Vercel, pindahkan folder compile view ke /tmp
        if (config('app.env') === 'production' || env('APP_ENV') === 'production') {
            config(['view.compiled' => '/tmp/storage/framework/views']);
        }
    }
}
