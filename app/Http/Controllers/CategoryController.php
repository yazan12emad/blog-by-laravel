<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService){}

    public function showCategory()
    {
        $this->authorize('viewAny', Category::class);

        $category = Category::paginate(6);
        return view('category.show', [
            'Categories' => $category
        ]);

    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('create', Category::class);

        try {
            $this->categoryService->addCategory($request->validated());
            return redirect()->route('category.show')
                ->with('Success', 'Category created!');
        } catch (\Exception $exception) {
            return redirect()->route('category.show')
                ->with('Failed', $exception->getMessage());
        }
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        try {
            $wasChange = $this->categoryService->update($request->validated(), $category);
            return redirect()->route('category.show')->with(
                $wasChange ? 'Success' : 'Pending',
                $wasChange ? 'Category updated successfully!' : 'No changes were made.'
            );
        } catch (\Exception $e) {
            return back()->with('Failed', $e->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        try {
            $this->categoryService->deleteCategory($category);
        } catch (\Exception $exception) {
            return back()->withErrors(['Failed' => $exception->getMessage()]);
        }
        return redirect()->route('category.show')->with('Success', 'Category deleted!');
    }


}
