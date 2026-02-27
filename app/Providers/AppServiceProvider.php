<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\TestAvailabilityService;
use Illuminate\Support\Facades\Auth;

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
        View::composer('*', function ($view) {
            if (!Auth::check()) return;

            static $cached = null;

            if ($cached === null) {
                $service = app(TestAvailabilityService::class);
                $cached = $service->forUser(Auth::user());
            }

            $view->with('testAvailability', $cached);
        });
    }
}
