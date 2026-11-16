<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AuthorizedSystemService;
use App\Services\Impl\AuthorizedSystemServiceImpl;
use Laravel\Passport\Passport;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AuthorizedSystemService::class, AuthorizedSystemServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Passport::enablePasswordGrant();
        RateLimiter::for('api-dynamic', function (Request $request) {
        $rateLimit = $request->attributes->get('api_consumer_rate_limit', 60);
        $consumerId = $request->attributes->get('api_consumer_id', $request->ip());

        return Limit::perMinute($rateLimit)->by($consumerId);
    });
    }
}
