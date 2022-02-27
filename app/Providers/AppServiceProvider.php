<?php

namespace App\Providers;

use App\Models\Bank;
use App\Models\Post;
use App\Models\User;
use App\Models\Agent;
use App\Models\Order;
use App\Models\Period;
use App\Models\Thread;
use App\Models\Vendor;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Property;
use App\Models\Semester;
use App\Models\OrderDetail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        $this->bootEloquentMorphsRelations();
    }

    public function bootEloquentMorphsRelations()
    {
        Relation::morphMap([
            Thread::TABLE => Thread::class,
            User::TABLE => User::class,
            Vendor::TABLE => Vendor::class,
            Product::TABLE => Product::class,
            Agent::TABLE => Agent::class,
            Property::TABLE => Property::class,
            Booking::TABLE => Booking::class,
            Post::TABLE => Post::class,
            Period::TABLE => Period::class,
            Semester::TABLE => Semester::class,
            Bank::TABLE => Bank::class,
            OrderDetail::TABLE => OrderDetail::class,
            Order::TABLE => Order::class,
        ]);
    }
}
