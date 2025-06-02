<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\UserLoggedIn; // Add this import
use App\Events\UserLoggedOut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showSignup()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users|min:3|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        if ($request->role === 'admin') {
            $adminCount = User::whereIn('role', ['admin', 'super_admin'])->count();
            if ($adminCount >= 3) {
                return back()->withErrors([
                    'role' => 'The maximum number of admin accounts (3) has been reached.',
                ])->withInput();
            }
        }

        $user = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Registration successful! Welcome to Eco Track Admin.');
        }

        return redirect()->route('home')->with('success', 'Registration successful! Welcome to Eco Track.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Update last_login_at on login
            $user->update(['last_login_at' => now()]);

            if ($user->role === 'admin' || $user->role === 'super_admin') {
                // Broadcast the UserLoggedIn event
                event(new UserLoggedIn($user));
                return redirect()->route('admin.dashboard')->with('success', 'Login successful! Welcome back to Admin Dashboard.');
            }

            return redirect()->route('home')->with('success', 'Login successful! Welcome back.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($user && in_array($user->role, ['admin', 'super_admin'])) {
            // Record the logout activity
            \App\Models\Activity::create([
                'user_id' => $user->id,
                'description' => 'telah keluar dari sistem',
                'status' => 'logout',
                'created_at' => now(),
            ]);

            // Broadcast the UserLoggedOut event
            event(new UserLoggedOut($user));
        }

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
