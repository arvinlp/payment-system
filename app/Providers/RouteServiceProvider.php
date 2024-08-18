<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // Route::middleware('api')
            //     ->prefix('api')
            //     ->group(base_path('routes/api.php'));

            Route::middleware(['web'])
                ->namespace('App\Http\Controllers\V1')
                ->group(function(){
                    Route::namespace('Admin')
                        ->middleware(['web', 'auth', 'is_admin'])
                        ->prefix('admin')
                        ->name('admin.')
                        ->group(base_path('routes/admin.php'));
                    Route::namespace('Client')
                        ->middleware(['web', 'auth', 'is_client'])
                        ->prefix('client')
                        ->name('client.')
                        ->group(base_path('routes/client.php'));
                    Route::namespace('Auth')
                        ->prefix('auth')
                        ->name('auth.')
                        ->group(base_path('routes/auth.php'));

                    Route::prefix('/')
                        ->group(base_path('routes/web.php'));
                });
        });
    }
}