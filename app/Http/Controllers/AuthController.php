<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailValidation;
use App\Http\Requests\logInRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function __construct(private AuthServices $authServices){}

    public function showRegisterPage()
    {
        return view('auth.register');
    }

    public function register(StoreUserRequest $request)
    {
        try {
            $user = $this->authServices->registerUser($request->validated());
        } catch (\Exception $e) {
            return back()->withErrors([
                'generalError' => 'Error happen please try again'
            ]);
        }
        auth()->login($user);
        $request->session()->regenerate();
        return redirect()->route('verification.notice')
            ->with('Success', 'Account created successfully! Please verify your email.');
    }

    public function LogIn(logInRequest $request)
    {
        $key = $request->email . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 4)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }
        try {
            $user = $this->authServices->logIn($request->validated());
        } catch (\Exception $e) {
            RateLimiter::hit($key, 60);
            return back()->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
        RateLimiter::clear($key);
        auth()->login($user, $request->filled('remember'));
        $request->session()->regenerate();

        return redirect('/')->with('Success', 'Login successful!');
    }

    public function showLogInPage()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        $this->authServices->logOut($request);
        return redirect('/')->with('Success', 'Logged out successfully!');
    }
}
