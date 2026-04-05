<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class SessionController extends Controller
{

    public function showLogInPage()
    {
        return view('auth.login');
    }

    public function LogIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $key = $request->email . $request->ip();
        $seconds = RateLimiter::availableIn($key);

        if (RateLimiter::tooManyAttempts($key, 2)) {
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }

        if (auth()->attempt([
                'email' => $request->email,
                'password' => $request->password]
            , $request->filled('remember')
        )) {
            RateLimiter::clear($key);
            $request->session()->regenerate();
            return redirect('/ideas');
        }

        RateLimiter::hit($key, 60);

        return back()->withErrors([
            'email' => 'These Email do not match our records.'
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('ideas')->with('success', 'Logged out successfully!');
    }
}
