<?php

// Controller: MoodController — handle mood tracker (mood.png, riwayat mood.png)
namespace App\Http\Controllers;

use App\Models\MoodLog;
use Illuminate\Http\Request;

class MoodController extends Controller
{
    // Tampilkan halaman mood tracker
    public function index()
    {
        $today = now()->today();
        $todayMood = MoodLog::where('user_id', auth()->id())
            ->whereDate('date', $today)
            ->first();

        $history = MoodLog::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        return view('mood.index', compact('todayMood', 'history'));
    }

    // Simpan mood hari ini
    public function store(Request $request)
    {
        $request->validate([
            'mood' => ['required', 'string', 'in:senang,biasa,sedih,stres,lelah,cemas'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        $today = now()->today();

        MoodLog::updateOrCreate(
            ['user_id' => auth()->id(), 'date' => $today],
            ['mood' => $request->mood, 'note' => $request->note]
        );

        return redirect()->route('mood.index')->with('success', 'Mood berhasil dicatat!');
    }
}
