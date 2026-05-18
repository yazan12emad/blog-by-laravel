<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Models\Blog;
use App\Models\Like;
use App\Services\LikeServices;

class LikeController extends Controller
{
    public function __construct(private LikeServices $likeServices){}

    public function toggleLike(Blog $blog)
    {
        try {
            $user = auth()->user();
            if ($user->checkIfLiked($blog)) {
                $this->destroy($blog);
                return back();
            }
            else {
                $this->addLike($blog);
                return back();
            }
        } catch (\Exception $exception) {
            return back()->with('Failed', $exception->getMessage());
        }
    }
    public function addLike(Blog $blog)
    {
        $this->authorize('create', Like::class);
        $this->likeServices->storeLike($blog);
    }
    public function destroy(Blog $blog)
    {
        $like = Like::where('blog_id', $blog->id)
            ->where('user_id', auth()->id())
            ->first();

        $this->authorize('deleteLike',$like);
        $this->likeServices->deleteLike($blog);
    }
}
