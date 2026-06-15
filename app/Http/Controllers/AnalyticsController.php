<?php

// Controller: AnalyticsController — statistik dan analisis pengguna
namespace App\Http\Controllers;

use App\Models\FocusSession;
use App\Models\MoodLog;
use App\Models\Task;

class AnalyticsController extends Controller
{
    // Tampilkan halaman analitik
    public function index()
    {
        $userId = auth()->id();

        // Statistik mood
        $moodLogs = MoodLog::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        $moodDistribution = $moodLogs->groupBy('mood')->map->count();

        // Statistik tugas
        $totalTasks = Task::where('user_id', $userId)->count();
        $completedTasks = Task::where('user_id', $userId)->where('status', 'completed')->count();
        $pendingTasks = Task::where('user_id', $userId)->where('status', 'pending')->count();
        $inProgressTasks = Task::where('user_id', $userId)->where('status', 'in_progress')->count();
        $taskCompletionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // Statistik fokus
        $totalFocusSessions = FocusSession::where('user_id', $userId)->count();
        $todayFocusSessions = FocusSession::where('user_id', $userId)
            ->whereDate('completed_at', now()->today())
            ->count();
        $totalFocusMinutes = FocusSession::where('user_id', $userId)
            ->sum('duration');
        $totalFocusMinutes = round($totalFocusMinutes / 60);

        // Mood streak — hitung consecutive days kebelakang dari hari ini
        $streak = 0;
        $checkDate = now()->today();
        foreach ($moodLogs as $log) {
            if ($log->date->eq($checkDate)) {
                $streak++;
                $checkDate->subDay();
            } elseif ($log->date->lt($checkDate)) {
                break;
            }
        }

        // Mood terbanyak
        $topMood = $moodDistribution->sortDesc()->keys()->first();

        return view('analytics.index', compact(
            'moodLogs', 'moodDistribution',
            'totalTasks', 'completedTasks', 'pendingTasks', 'inProgressTasks',
            'taskCompletionRate', 'streak', 'topMood',
            'totalFocusSessions', 'todayFocusSessions', 'totalFocusMinutes',
        ));
    }
}
