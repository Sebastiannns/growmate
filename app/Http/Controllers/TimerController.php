<?php

// Controller: TimerController — handle focus timer page (timer.png)
namespace App\Http\Controllers;

use App\Models\FocusSession;
use Illuminate\Http\Request;

class TimerController extends Controller
{
    // Tampilkan halaman focus timer
    public function index()
    {
        $todayCount = FocusSession::where('user_id', auth()->id())
            ->whereDate('completed_at', now()->today())
            ->count();

        return view('timer.index', compact('todayCount'));
    }

    // Simpan sesi fokus selesai
    public function store(Request $request)
    {
        $request->validate([
            'mode' => ['required', 'in:focus,short,long'],
            'duration' => ['required', 'integer', 'min:1'],
        ]);

        FocusSession::create([
            'user_id' => auth()->id(),
            'mode' => $request->mode,
            'duration' => $request->duration,
            'completed_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }
}
