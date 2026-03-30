<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password])) {
            $request->session()->regenerate();

        return redirect('/ideas');
    }

        return back()->withErrors([
        'email' =>'These credentials do not match our records.' ]);

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {

        auth()->logout();

        return redirect('ideas')->with('success', 'Logged out successfully!');
    }
}
