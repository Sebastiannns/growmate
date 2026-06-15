<?php

// Migrasi: tabel focus_sessions — menyimpan sesi fokus pengguna
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('focus_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('mode'); // focus, short, long
            $table->integer('duration'); // durasi dalam detik
            $table->timestamp('completed_at')->useCurrent();
            $table->timestamps();
            $table->index(['user_id', 'completed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('focus_sessions');
    }
};
