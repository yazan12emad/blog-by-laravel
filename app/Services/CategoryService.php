<?php

namespace App\Services;

use App\Models\Category;
use App\Models\User;
use mysql_xdevapi\Exception;


class CategoryService
{
    public function addCategory(array $data )
    {
        if(!auth()->user()->isAdmin()){
            throw new \Exception("Unauthorized: Only admin users can create categories.");
        }

        $admin_user_id = auth()->id();

           return Category::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'admin_id' => $admin_user_id,
        ]);
    }
    public function update(array $data, Category $category)
    {
        $category->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
        return $category->wasChanged();

    }

    public function deleteCategory(Category $category): true
    {
        if (!$category->delete()) {
            throw new \Exception("Failed to delete category");
        }
        return true;

    }


}
