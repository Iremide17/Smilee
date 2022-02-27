<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::if('subscribed', function ($user) {
            return $user->subscribed('default');
        });

        Blade::if('notsubscribed', function ($user) {
            return !($user->subscribed('default'));
        });

        Blade::if('subscribedToProduct', function ($user, $id, $name) {
            return $user->subscribedToProduct($id, $name);
        });

        // Blade::if('onGracePeriod', function ($plan) {
        //     return auth()->user()->subscription($plan)->onGracePeriod();
        // });

        Blade::if('onTrial', function ($user, $plan) {
            return $user->onTrial($plan);
        });

        Blade::if('admin', function () {
            $user = auth()->user();
            return ($user->isAdmin() || $user->isSuperAdmin());
        });

        Blade::if('writer', function () {
            $user = auth()->user();
            return ($user->isWriter() || $user->isAdmin() || $user->isSuperAdmin());
        });

        Blade::if('agent', function () {
            $user = auth()->user();
            return ($user->isAgent() || $user->isAdmin() || $user->isSuperAdmin());
        });

        Blade::if('vendor', function () {
            $user = auth()->user();
            return ($user->isvendor() || $user->isAdmin() || $user->isSuperAdmin());
        }); 
    }
}
