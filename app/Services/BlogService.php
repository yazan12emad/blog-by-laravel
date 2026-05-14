<?php

namespace App\Services;

use App\Models\Blog;

class BlogService
{
    public function __construct(private FileUploadService $fileUploadService ){}

    public function addBlog(array $data): bool{

        if(Blog::create($data))
            return true;

         throw new \Exception("Failed to create blog");

    }
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
            'short_desc'=>$data['short_desc'],
            'body'=>$data['body'],
            'category_id'=>$data['category_id'],
            'status'=>$data['status']
        ]);
        return $blog->wasChanged();
    }

    public function handleImages($image){
        try {
            return $this->fileUploadService->uploadFile($image, 'Blog_upload_Images', 'public');
        }
        catch (\Exception $exception){
            throw new \Exception("Failed to upload image");
        }

    }

}
