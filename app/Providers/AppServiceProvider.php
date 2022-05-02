<?php

namespace App\Providers;

use App\Contracts\Cart\CartManager as CartManagerContract;
use App\Foundation\Cart\CartManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        $this->app->bind(CartManagerContract::class, CartManager::class);

        $this->app->singleton('shop.cart', function ($app) {
            return $app->make(CartManagerContract::class);
        });
    }
}
