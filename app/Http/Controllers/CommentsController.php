<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use App\Models\Blog;
use App\Models\Comments;
use App\Services\CommentServices;
use mysql_xdevapi\Exception;

class CommentsController extends Controller
{
    public function __construct(private CommentServices $commentServices){}

    public function addComments(StoreCommentsRequest $request, Blog $blog)
    {
        $this->authorize('create', Comments::class);
        try{
            $this->commentServices->createComment($request->validated(), $blog);
            return back()->with('Success' , 'Comment added successfully');
        }
        catch (Exception $exception){
            return back()->with('Failed' , $exception->getMessage());
        }

    }

    public function destroy(Blog $blog , Comments $comment)
    {
        $this->authorize('deleteComment', $comment);
        try{
            $this->commentServices->deleteComment($comment);
            return back()->with('Success' , 'Comment added successfully');
        }
        catch (Exception $exception){
            return back()->with('Failed' , $exception->getMessage());
        }

    }


}
