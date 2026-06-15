<?php

namespace App\Http\ViewComposers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationComposer
{
    public function compose(View $view): void
    {
        $unreadCount = 0;

        if (Auth::check()) {
            $unreadCount = Notification::where('user_id', Auth::id())
                ->where('is_read', false)
                ->count();
        }

        $view->with('unreadNotificationCount', $unreadCount);
    }
}
