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
        View::composer([
            'partials.navbar',
            'partials.navbar-publico',
            'partials.navbar-especialista',
        ], function ($view) {

            if (!Auth::check()) {
                return;
            }

            $service = app(TestAvailabilityService::class);
            $view->with('testAvailability', $service->forUser(Auth::user()));
        });
    }
}
