<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

// ───────────────────────────── public Routes  ───────────────────────────────────────────────────────────
Route::get('Home', function () {
    return view('welcome', [
        'tasks' => [],
        'name'  => request('name', auth()->user()?->name ?? 'Guest'),
    ]);
});

Route::get('/Blogs', [BlogController::class, 'showBlogs'])
    ->name('blogs.show');
Route::get('/Category', [CategoryController::class, 'showCategory'])
    ->name('category.show');

// ───────────────────────────── Guest Routes  ───────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    // register
    Route::get('register', [AuthController::class, 'showRegisterPage'])
        ->name('register');
    Route::post('register', [AuthController::class, 'register']);
    // Log In
    Route::get('logIn', [AuthController::class, 'showLogInPage'])
        ->name('LogIn');
    Route::post('logIn', [AuthController::class, 'LogIn']);

    // reset password
    Route::get('forgot-password',[ResetPasswordController::class, 'showForgotPasswordPage'])
        ->name('forgot-password.form');

    Route::post('forgot-password',[ResetPasswordController::class, 'sendResetLinkEmail'])
        ->middleware('throttle:6,1')
        ->name('submit.forgot-password.form');

    Route::get('reset-password',[ResetPasswordController::class, 'showResetPasswordPage'])
        ->middleware('signed')
        ->name('change-password.form');

    Route::post('reset-password',[ResetPasswordController::class, 'resetPassword'])
        ->middleware('throttle:6,1')
        ->name('submit.reset-password.form');

});

// ───────────────────────────── Email verification Routes  ───────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    // Check your email notice page
    Route::get('/email/verify', [VerificationController::class, 'notice'])
        ->name('verification.notice');

    // Link clicked inside the email
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    // Resend button
    Route::post('/email/resend', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

// ───────────────────────────── Auth , varified email Routes  ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
    // log out
    Route::delete('logout', [AuthController::class, 'logout']);
    // profile
    Route::get('profile/{user}', [ProfileController::class, 'showProfile'])
        ->name('profile');
    Route::patch('profile/{user}', [ProfileController::class, 'update'])
        ->name('profile.update');
    // category
    Route::patch('/category/update/{category}', [CategoryController::class, 'update'])
        ->name('category.update');
    Route::post('/category/create', [CategoryController::class, 'store'])
        ->name('category.store');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])
        ->name('category.destroy');
    // Blog
    Route::get('/blogs/{blog}', [BlogController::class, 'showBlogDetails'])
        ->name('blog.show.details');
    Route::post('/blog/create', [BlogController::class, 'store'])
        ->name('blog.store');
    Route::get('/blog/{category}', [BlogController::class, 'showBlogsByCategory'])
        ->name('blog.by.category');
    Route::patch('/blogs/update/{blog}', [BlogController::class, 'update'])
        ->name('blog.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])
        ->name('blog.destroy');
});

// ───────────────────────────── fallback Route  ───────────────────────────────────────────────────────────
Route::fallback(function () {
    return redirect('Home');
});
