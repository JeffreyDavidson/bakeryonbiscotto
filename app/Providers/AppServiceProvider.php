<?php

namespace App\Providers;

use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use App\Observers\ContactMessageObserver;
use App\Observers\OrderObserver;
use App\Observers\ReviewObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('access-admin-panel', fn (User $user): bool => in_array($user->email, config('saas.admin_emails', []), true));

        Order::observe(OrderObserver::class);
        ContactMessage::observe(ContactMessageObserver::class);
        Review::observe(ReviewObserver::class);
    }
}
