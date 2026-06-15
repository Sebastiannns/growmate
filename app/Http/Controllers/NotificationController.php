<?php

// Controller: NotificationController — handle notifikasi internal
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Tampilkan daftar notifikasi
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('notification.index', compact('notifications'));
    }

    // Tandai notifikasi sebagai dibaca
    public function read(Notification $notification)
    {
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->update(['is_read' => true, 'read_at' => now()]);

        if ($notification->url) {
            return redirect($notification->url);
        }

        return redirect()->route('notification.index');
    }

    // Tandai semua notifikasi sebagai dibaca
    public function readAll()
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return redirect()->route('notification.index');
    }
}
