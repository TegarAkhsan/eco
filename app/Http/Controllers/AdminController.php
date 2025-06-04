<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use App\Models\Activity;
use App\Events\UserLoggedIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $currentUser = Auth::user();
        if ($currentUser && in_array($currentUser->role, ['admin', 'super_admin'])) {
            Activity::where('user_id', $currentUser->id)
                ->where('status', 'login')
                ->delete();

            Activity::create([
                'user_id' => $currentUser->id,
                'description' => 'telah masuk ke sistem',
                'status' => 'login',
                'created_at' => now(),
            ]);

            event(new UserLoggedIn($currentUser));
        }

        $activeUsers = User::whereIn('role', ['admin', 'super_admin'])
            ->whereNotNull('last_login_at')
            ->where('last_login_at', '>=', now()->subMinutes(15))
            ->get();

        $activities = Activity::with('user')
            ->whereHas('user', function ($query) {
                $query->whereIn('role', ['admin', 'super_admin']);
            })
            ->where('status', 'login')
            ->latest()
            ->limit(5)
            ->get();

        $reports = Report::all(); // Atau gunakan paginasi: Report::paginate(10)
        $totalReports = Report::count();
        $trashPoints = 85; // Ganti dengan query yang sesuai
        $activeWasteBanks = 32; // Ganti dengan query yang sesuai
        $registeredTPAs = 14; // Ganti dengan query yang sesuai

        return view('admin.index', compact('activeUsers', 'activities', 'reports', 'totalReports', 'trashPoints', 'activeWasteBanks', 'registeredTPAs'));
    }
}
