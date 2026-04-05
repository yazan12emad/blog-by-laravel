<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function showRegisterPage ()
    {
        return view('auth.register');
    }

    public function register(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);
        $request->session()->regenerate();


        // Redirect to home page
        return redirect('/')->with('success', 'Registration successful!');
    }
}
