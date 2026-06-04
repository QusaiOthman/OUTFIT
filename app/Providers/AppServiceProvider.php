<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;


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
        URL::forceScheme('https');


        View::composer('*', function ($view) {

            $wishlistCount = 0;
            $cartCount = 0;

            if (Auth::check()) {

                /** @var User $user */
                $user = Auth::user();

                $user->loadMissing([
                    'wishlistItems',
                    'cart.items'
                ]);

                $wishlistCount = $user->wishlistItems->count();

                $cartCount = $user->cart
                    ? $user->cart->items->sum('quantity')
                    : 0;
            }

            $view->with([
                'wishlistCount' => $wishlistCount,
                'cartCount' => $cartCount,
            ]);
        });
    }
}
