<?php

namespace App\Providers;

use App\Http\Middleware\IsMasterMiddleware;
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
     * Define your route model bindings, pattern filters, and other route
     * configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id
                ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware([
                'web', 'auth',
            ])
                ->prefix('profile')
                ->group([
                    base_path('routes/profile.php'),
                ]);

            Route::middleware('web')
                ->group([
                    base_path('routes/web.php'),
                    base_path('routes/auth.php'),
                ]);

            Route::middleware([
                'web',
            ])
                ->prefix('client/advertisement')
                ->name('client.advertisement.')
                ->group(
                    base_path('routes/client-advertisement.php')
                );

            Route::middleware([
                'web',
            ])
                ->prefix('master/advertisement')
                ->name('master.advertisement.')
                ->group(
                    base_path('routes/master-advertisement.php')
                );

            Route::middleware(['web', 'auth', IsMasterMiddleware::class])
                ->prefix('master-payment')
                ->name('master-payment.')
                ->group(
                    base_path('routes/master-payment.php')
                );

            Route::middleware(['web', 'auth', IsMasterMiddleware::class])
                ->prefix('subscription')
                ->name('subscription.')
                ->group(
                    base_path('routes/subscription.php')
                );
        });
    }

}
