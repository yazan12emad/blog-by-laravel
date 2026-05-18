<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Comments;
use mysql_xdevapi\Exception;

class CommentServices
{

    public function createComment(array $data, Blog $blog): true
    {
        if(Comments::create([
            'blog_id'=>$blog->id,
            'user_id'=>auth()->user()->id,
            'comment_body'=>$data['comment_body']
        ])){
            return true;
        }
        throw new Exception('Failed to create comment');
    }

    public function deleteComment(Comments $comment): true
    {
        if($comment->delete()){
            return true;
        }
        throw new Exception('Failed to delete comment');
    }

}
