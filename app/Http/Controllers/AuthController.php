<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Events\UserLoggedIn;
use App\Events\UserLoggedOut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Menampilkan halaman signup.
     *
     * @return \Illuminate\View\View
     */
    public function showSignup()
    {
        return view('auth.signup');
    }

    /**
     * Menangani pendaftaran pengguna baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        // Memeriksa batasan jumlah admin
        if ($request->role === 'admin') {
            $adminCount = User::whereIn('role', ['admin', 'super_admin'])->count();
            if ($adminCount >= 3) {
                return back()->withErrors([
                    'role' => 'Maaf, jumlah akun admin maksimum (3) telah tercapai. Silakan hubungi administrator.',
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
            'last_login_at' => null, // Inisialisasi last_login_at
        ]);

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Pendaftaran berhasil! Selamat datang di Eco Track Admin.');
        }

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil! Selamat datang di Eco Track.');
    }

    /**
     * Menangani proses login pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Update last_login_at saat login
            $user->update(['last_login_at' => now()]);

            // Broadcast event login untuk admin/super_admin
            if (in_array($user->role, ['admin', 'super_admin'])) {
                event(new UserLoggedIn($user));
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil! Selamat datang kembali di Admin Dashboard.');
            }

            return redirect()->route('home')->with('success', 'Login berhasil! Selamat datang kembali.');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Mencatat aktivitas logout untuk admin/super_admin
            if (in_array($user->role, ['admin', 'super_admin'])) {
                Activity::create([
                    'user_id' => $user->id,
                    'description' => 'telah keluar dari sistem',
                    'status' => 'logout',
                    'created_at' => now(),
                ]);

                // Broadcast event logout
                event(new UserLoggedOut($user));
            }
        }

        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
