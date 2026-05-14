<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

$homePage = function () {
    return view('welcome', [
        'tasks' => [],
        'name' => request('name', auth()->user()?->name ?? 'Guest'),
    ]);
};

Route::get('Home', $homePage);

Route::view('notes', "notes");


Route::middleware('auth')->group(function () {
    Route::delete('logout', [AuthController::class, 'logout']);

    Route::get('profile/{user}', [ProfileController::class, 'showProfile'])->name('profile');
    Route::patch('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');


    Route::patch('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/blogs/{blog}', [BlogController::class, 'showBlogDetails'])->name('blog.show.details');
    Route::post('/blog/create' , [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{category}', [BlogController::class, 'showBlogsByCategory'])->name('blog.by.category');
    Route::patch('/blogs/update/{blog}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');

//    Route::middleware('role:admin')->group(function () {
//        Route::get('admin', function () {
//            dd('admin');
//        })->name('admin');
//    });

});

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegisterPage'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('logIn', [AuthController::class, 'showLogInPage'])->name('LogIn');
    Route::post('logIn', [AuthController::class, 'LogIn']);

});

Route::get('/Blogs', [BlogController::class, 'showBlogs'])->name('blogs.show');
Route::get('/Category', [CategoryController::class, 'showCategory'])->name('category.show');


Route::fallback(function () {
    return redirect('Home');
});


