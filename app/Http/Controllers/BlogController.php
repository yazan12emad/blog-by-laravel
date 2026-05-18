<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlog;
use App\Http\Requests\UpdateBlog;
use App\Models\Blog;
use App\Models\Category;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(private BlogService $blogService){}
    public function showBlogs()
    {
        $blogs = Blog::with(['category', 'author'])
            ->where('status' , 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $categories = Category::all();

        return view('blog.index', [
            'blogs' => $blogs,
            'categories' => $categories,
        ]);
    }
    public function showBlogDetails(Blog $blog)
    {
        $blog->load(['category', 'author' , 'comments'])
            ->loadCount('likes')
            ->loadCount('comments');
        $categories = Category::all(); // lowercase

        return view('blog.blogInDetails', [
            'blog' => $blog,
            'categories' => $categories, // lowercase
        ]);
    }

    public function store(StoreBlog $request)
    {
        $this->authorize('create', Blog::class);
        try {
            if ($request->hasFile('image')) {
                $imagePath = $this->blogService->handleImages($request->file('image'));
            }
            $this->blogService->addBlog(array_merge($request->validated(), ['author_id' => auth()->id() , 'image' => $imagePath??'']));
        } catch (\Exception $exception){
            return redirect()->route('blogs.show')->with('Failed', $exception->getMessage());
        }

        return redirect()->route('blogs.show')->with('Success', 'Blog created successfully');
    }

    public function showBlogsByCategory(Blog $blog, Category $category)
    {
        $blogs = Blog::with(['category', 'author'])
            ->where('category_id', $category->id)
            ->paginate(6);
        $categories = Category::all();

        return view('blog.index', [
            'blogs' => $blogs,
            'categories' => $categories,
        ]);
    }

    public function update(UpdateBlog $request, Blog $blog)
    {
//        $this->authorize('user-blog', $blog); Gate
        $this->authorize('update', $blog); // policy
        try {
            $data = $request->validated();

            if($request->hasFile('image')){
                $imagePath = $this->blogService->handleImages($request->file('image') ,$blog->image);
                $data['image'] = $imagePath;
            }

            $wasChanged = $this->blogService->updateBlog($blog, $data);
            $message = $wasChanged ? 'Blog updated successfully.' : 'No changes were made.';
            return redirect()->route('blog.show.details', $blog->id)->with('Success', $message);

        } catch (\Exception $exception) {
            return redirect()->route('blog.show.details', $blog->id)->with('Failed', $exception->getMessage());
        }
    }

    public function destroy(Blog $blog)
    {
//        $this->authorize('user-blog', $blog); Gate
        $this->authorize('delete', $blog); // policy
        try {
            $this->blogService->deleteBlog($blog);
        } catch (\Exception $exception) {
            return redirect()->route('blogs.show')->with('Failed', $exception->getMessage());
        }
        return redirect()->route('blogs.show')->with('Success', 'Blog deleted successfully');
    }
}
