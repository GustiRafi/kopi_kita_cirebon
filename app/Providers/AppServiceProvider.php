<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;

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
        // gate for waiter
        Gate::define('waiter', function (User $user) {
            return $user->level === 'waiter';
        });

        // gate for admin
        Gate::define('admin', function (User $user) {
            return $user->level === 'admin';
        });

        // gate for kasir
        Gate::define('kasir', function (User $user) {
            return $user->level === 'kasir';
        });

        // gate for owner
        Gate::define('owner', function (User $user) {
            return $user->level === 'owner';
        });
        
    }
}
