<?php

namespace App\Services;

use App\Models\Blog;

class BlogService
{
    public function deleteBlog(Blog $blog)
    {
       if($blog->delete()){
           return true;
       }
       throw new \Exception("Failed to delete blog");

    }

    public function updateBlog(Blog $blog,array $data){
        $blog->update([
            'title'=>$data['title'],
            'body'=>$data['body'],
            'category_id'=>$data['category_id'],
            'status'=>$data['status']
        ]);
        return $blog->wasChanged();
    }

}
