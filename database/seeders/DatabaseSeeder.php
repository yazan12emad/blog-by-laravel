<?php

namespace Database\Seeders;


use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {
     Category::factory(10)->create();
     Blog::factory(10)->create();

    }
}
