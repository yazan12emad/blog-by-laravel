<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Like;
use mysql_xdevapi\Exception;

class LikeServices
{

    public function storeLike(Blog $blog)
    {
        if (Like::create([
            'blog_id' => $blog->id,
            'user_id' => auth()->id()
        ])) {
            return true;
        }
        throw new Exception("Failed to add like");
    }

    public function deleteLike(Blog $blog): true
    {
        $like = Like::where('blog_id', $blog->id)
            ->where('user_id', auth()->id())->first();
        if ($like) {
            $like->delete();
            return true;
        }
        throw new Exception("Failed to remove like");
    }


}
