<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
         return view('login');
    }
    
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['error' => 'Invalid user!']);
        }

        if (Auth::attempt($validated)) {
            return redirect()->route(strtolower($user->role) . "." . "dashboard");
        }


        return back()->withErrors(['email' => 'Invalid credentials!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login-page');
    }
}
