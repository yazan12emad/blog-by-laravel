<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBlog;
use App\Models\Blog;
use App\Models\Category;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(private BlogService $blogService)
    {
    }

    public function showBlogs()
    {
        $blogs = Blog::with(['category', 'author'])->paginate(6);

        return view('blog.index', [
            'blogs' => $blogs,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showBlogDetails(Blog $blog)
    {
        $blog->load(['category', 'author']);
        $categories = Category::all(); // lowercase

        return view('blog.blogInDetails', [
            'blog' => $blog,
            'categories' => $categories, // lowercase
        ]);
    }

    public function showBlogsByCategory(Blog $blog, Category $category)
    {
        $blogs = Blog::with(['category', 'author'])
            ->where('category_id', $category->id)
            ->paginate(6);
        return view('blog.index', [
            'blogs' => $blogs
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlog $request, Blog $blog)
    {
        $this->authorize('user-blog', $blog);
        try {
            $wasChanged = $this->blogService->updateBlog($blog, $request->validated());
            $message = $wasChanged ? 'Blog updated successfully.' : 'No changes were made.';
            return redirect()->route('blog.show.details', $blog->id)->with('Success', $message);

        } catch (\Exception $exception) {
            return redirect()->route('blog.show.details', $blog->id)->with('Failed', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $this->authorize('user-blog', $blog);
        try {
            $this->blogService->deleteBlog($blog);
        } catch (\Exception $exception) {
            return redirect()->route('blogs.show')->with('Failed', $exception->getMessage());
        }
        return redirect()->route('blogs.show')->with('Success', 'Blog deleted successfully');
    }
}
