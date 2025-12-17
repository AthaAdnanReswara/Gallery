<?php

namespace App\Providers;

use App\Models\album;
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
        // Share data album ke SEMUA view
        view()->composer('*', function ($view) {
            $albums = album::where('is_active', true)
                ->orderBy('name', 'asc')
                ->get();

            $view->with('albums', $albums);
        });
    }
}
