<?php

namespace App\Policies;

use App\Models\Comments;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentsPolicy
{

    public function create(User $user): bool
    {
        return $user->isVerified();
    }

    public function update(User $user, Comments $comments): bool
    {
        return ($user->isVerified() && $comments->user->is($user));
    }

    public function deleteComment(User $user, Comments $comments): bool
    {
        return ($user->isVerified() && $comments->user->is($user));
    }


}
