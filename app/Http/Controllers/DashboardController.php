<?php

// DashboardController: handle halaman beranda (beranda.png) setelah login
namespace App\Http\Controllers;

use App\Models\MoodLog;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Redirect ke dashboard spesifik berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'counselor') {
            return redirect()->route('counselor.dashboard');
        }

        // Student dashboard
        $today = now()->today();

        $todayMood = MoodLog::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        $tasks = Task::where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            ->orderBy('deadline', 'asc')
            ->limit(5)
            ->get();

        $totalTasks = Task::where('user_id', $user->id)->count();
        $completedTasks = Task::where('user_id', $user->id)->where('status', 'completed')->count();

        return view('dashboard.index', compact('user', 'todayMood', 'tasks', 'totalTasks', 'completedTasks'));
    }
}
