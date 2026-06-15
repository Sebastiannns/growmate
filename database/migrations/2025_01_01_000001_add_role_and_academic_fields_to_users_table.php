<?php

// Migration: Tambah kolom role + data akademik ke tabel users
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Role: student (default), counselor, admin
            $table->enum('role', ['student', 'counselor', 'admin'])->default('student')->after('name');
            // Data akademik
            $table->string('nim')->nullable()->after('role');
            $table->string('jurusan')->nullable()->after('nim');
            $table->string('fakultas')->nullable()->after('jurusan');
            $table->integer('semester')->nullable()->after('fakultas');
            // Kontak
            $table->string('phone')->nullable()->after('email');
            // Avatar
            $table->string('avatar')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'nim', 'jurusan', 'fakultas', 'semester', 'phone', 'avatar']);
        });
    }
};
