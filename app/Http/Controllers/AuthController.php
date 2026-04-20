<?php

namespace App\Http\Controllers;

use App\Http\Requests\logInRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{

    public function showRegisterPage ()
    {
        return view('auth.register');
    }
    public function register(StoreUserRequest $request , AuthServices $authServices)
    {
        try {
            $user = $authServices->registerUser($request->validated());
        }
        catch (\Exception $e) {
            return back()->withErrors([
                'generalError' => 'Error happen please try again'
            ]);
        }
        auth()->login($user);
        $request->session()->regenerate();
        return redirect('/')->with('success', 'Registration successful!');
    }

    public function showLogInPage()
    {
        return view('auth.login');
    }

    public function LogIn(logInRequest $request , AuthServices $authServices){

        $key = $request->email . $request->ip();

        if(RateLimiter::tooManyAttempts($key, 4)){
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }

        try {
          $user =   $authServices->logIn($request->validated());
        }
        catch (\Exception $e) {
            RateLimiter::hit($key, 60);
            return back()->withErrors([
                'email' => $e->getMessage(),
                ]);
        }

        RateLimiter::clear($key);
        auth()->login($user, $request->filled('remember'));
        $request->session()->regenerate();

        return redirect('/')->with('success', 'Login successful!');
    }

    public function logout(Request $request , AuthServices $authService)
    {
        $authService->logOut($request);

        return redirect('/')->with('success', 'Logged out successfully!');
    }

}
