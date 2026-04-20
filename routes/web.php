<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ideaController;

$homePage = function () {
    return view('welcome', [
        'tasks' => [],
        'name' => request('name', auth()->user()?->name ?? 'Guest'),
    ]);
};

Route::get('/', $homePage);
Route::get('Home', $homePage);

Route::view('contact', "contact");

Route::view('about', "about");

Route::view('notes', "notes");



Route::middleware('auth')->group(function () {

//index - show all ideas
    Route::get('ideas', [ideaController::class, 'index']);
// create - show form
    Route::get('ideas/create', [ideaController::class, 'create']);
//show - show one idea
    Route::get('ideas/{idea}', [ideaController::class, 'show']);
// store idea
    Route::post('ideas', [ideaController::class, 'store']);
// edit idea
    Route::get('ideas/{idea}/edit', [ideaController::class, 'edit']);
// update idea
    Route::patch('ideas/{idea}', [ideaController::class, 'update']);
//destroy
    Route::delete('ideas/{idea}', [ideaController::class, 'destroy']);
//All the routes can be simplified to this line
//Route::resource('ideas', ideaController::class);

    Route::delete('logout', [AuthController::class, 'logout']);


    Route::get('profile/{user}', [ProfileController::class, 'showProfile'])->name('profile');

    Route::patch('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

});



Route::middleware('guest')->group(function () {

    Route::get('register', [AuthController::class, 'showRegisterPage'])->name('register');
    Route::post('register', [AuthController::class, 'register']);

    Route::get('logIn', [AuthController::class, 'showLogInPage'])->name('LogIn');
    Route::post('logIn', [AuthController::class, 'LogIn']);
});

Route::fallback(function () {
    return redirect('Home');
});


