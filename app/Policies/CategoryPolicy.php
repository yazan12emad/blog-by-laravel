<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }


    public function viewAny(User $user): bool
    {
        return true;
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }


    public function update(User $user, Category $category): bool
    {
        return $user->isAdmin();
    }


    public function delete(User $user, Category $category): bool
    {
        return $user->isAdmin();
    }
}


