<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-admin', function($user){
            return $user->isAdmin();

        });

        Gate::define('user-blog', function($user, $blog){
            return $user->id == $blog->author_id || $user->isAdmin();
        });
    }
}
