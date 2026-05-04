<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id'=>rand(1,User::count()),
            'title' => $this->faker->sentence(),
            'category_id'=>rand(1,Category::count()),
            'body'=>$this->faker->paragraph(),
            'short_desc'=>$this->faker->sentence(),
        ];
    }
}


