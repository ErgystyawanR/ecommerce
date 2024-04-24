<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
        View::composer('layouts.header', function ($view) {
            $user = Auth::user(); // Get the authenticated user
            if ($user) {
                $cartItemCount = Cart::where('user_id', $user->id)->count(); // Count items in the cart for the authenticated user
            } else {
                $cartItemCount = 0; // User is not authenticated, so cart item count is 0
            }
            $view->with('user', $user)->with('cartItemCount', $cartItemCount);
        });
    }
}
