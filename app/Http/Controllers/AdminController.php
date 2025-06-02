<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use App\Events\UserLoggedIn; // Add this import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Record the login activity for the current user, replace old login activity
        $currentUser = Auth::user();
        if ($currentUser && in_array($currentUser->role, ['admin', 'super_admin'])) {
            // Delete previous login activities for the current user
            Activity::where('user_id', $currentUser->id)
                ->where('status', 'login')
                ->delete();

            // Create new login activity
            Activity::create([
                'user_id' => $currentUser->id,
                'description' => 'telah masuk ke sistem',
                'status' => 'login',
                'created_at' => now(),
            ]);

            // Broadcast the UserLoggedIn event
            event(new UserLoggedIn($currentUser));
        }

        // Fetch users who are currently active (last login within 15 minutes)
        $activeUsers = User::whereIn('role', ['admin', 'super_admin'])
            ->whereNotNull('last_login_at')
            ->where('last_login_at', '>=', now()->subMinutes(15))
            ->get();

        // Fetch only the latest login activity for the authenticated user
        $activities = Activity::with('user')
            ->where('user_id', Auth::id())
            ->where('status', 'login')
            ->latest()
            ->limit(1)
            ->get();

        return view('admin.index', compact('activeUsers', 'activities'));
    }
}
