<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\User;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Category::class => CategoryPolicy::class,
    ];
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
        Gate::define('view-admin', function($user){
           if($user->role == 'admin')
            return true;
                return false;
        });

        Gate::define('user-blog', function($user , $blog){
            if($user->id == $blog->author_id || $user->role == 'admin'){
                return true;
            }
            return false;
        });
    }
}
