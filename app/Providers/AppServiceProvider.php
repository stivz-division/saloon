<?php

namespace App\Providers;

use App\Models\ClientAdvertisement;
use App\Models\User;
use App\Observers\ClientAdvertisementObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use YooKassa\Client;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Client::class, function () {
            $client = new Client();

            $client->setAuth(
                config('yookassa.shop_id'),
                config('yookassa.api_key')
            );

            return $client;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        ClientAdvertisement::observe(ClientAdvertisementObserver::class);
    }

}
