<?php

// Seeder: NotificationSeeder — contoh notifikasi untuk testing
namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Selamat datang di GrowMate!',
                'body' => 'Terima kasih telah bergabung. Mulai perjalananmu sekarang!',
                'type' => 'info',
                'url' => route('dashboard'),
                'is_read' => false,
            ]);

            Notification::create([
                'user_id' => $user->id,
                'title' => 'Coba fitur Mood Tracker',
                'body' => 'Catat perasaanmu setiap hari dan lihat perkembangannya!',
                'type' => 'success',
                'url' => route('mood.index'),
                'is_read' => false,
            ]);
        }
    }
}
