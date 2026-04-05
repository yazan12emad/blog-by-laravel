<?php

use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\SessionController;
use App\Models\ideas;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ideaController;


Route::get('Home', function () {
    return view('welcome', [
        'tasks' => [],
        'name' => request('name', 'yazan'),
    ]);
});

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

    Route::delete('logout', [SessionController::class, 'logout']);

});

Route::middleware('guest')->group(function () {

    Route::get('register', [RegisterUserController::class, 'showRegisterPage']);
    Route::post('register', [RegisterUserController::class, 'register']);

    Route::get('logIn', [SessionController::class, 'showLogInPage']);
    Route::post('logIn', [SessionController::class, 'LogIn']);
});

Route::fallback(function () {
    return redirect('Home');
});




