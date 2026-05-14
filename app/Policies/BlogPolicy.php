<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPolicy
{
//        public function before(User $user): bool
//        {
//            if ($user->isAdmin()) {
//                return true;
//            }
//            return false;
//        }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Blog $blog): bool
    {
        return auth()->check() && ($user->id === $blog->author_id || $user->isAdmin());
    }

    public function create(User $user): bool
    {
        return auth()->check();
    }

    public function update(User $user, Blog $blog): bool
    {
        return $blog->isOwnedBy($user) || $user->isAdmin();
    }

    public function delete(User $user, Blog $blog): bool
    {
        return $blog->isOwnedBy($user) || $user->isAdmin();
    }

}
