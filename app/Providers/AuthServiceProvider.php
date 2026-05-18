<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Like;
use App\Policies\BlogPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CommentsPolicy;
use App\Policies\LikePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use PhpParser\Comment;


class AuthServiceProvider extends ServiceProvider
{
    protected array $policies = [
        Category::class => CategoryPolicy::class,
        Blog::class => BlogPolicy::class,
        Like::class => LikePolicy::class,
        Comment::class => CommentsPolicy::class
    ];

    public function register(): void
    {

    }

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
