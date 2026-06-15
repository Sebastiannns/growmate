<?php

// Seeder: DatabaseSeeder — seed data awal aplikasi GrowMate
namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Community;
use App\Models\Consultation;
use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin GrowMate',
            'email' => 'admin@growmate.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Konselor
        $konselor = User::create([
            'name' => 'Dr. Sarah Wijaya',
            'email' => 'konselor@growmate.com',
            'password' => Hash::make('password'),
            'role' => 'counselor',
            'phone' => '081234567890',
        ]);

        // Mahasiswa
        $mahasiswa = User::create([
            'name' => 'Budi Santoso',
            'email' => 'mahasiswa@growmate.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'nim' => '2201234567',
            'jurusan' => 'Teknik Informatika',
            'fakultas' => 'Ilmu Komputer',
            'semester' => 4,
            'phone' => '081298765432',
        ]);

        // Sample konsultasi
        Consultation::create([
            'student_id' => $mahasiswa->id,
            'counselor_id' => $konselor->id,
            'topic' => 'Kecemasan menghadapi ujian',
            'description' => 'Saya merasa sangat cemas menghadapi ujian semester nanti',
            'consultation_date' => now()->addDays(2)->setHour(14)->setMinute(0),
            'status' => 'pending',
        ]);

        Consultation::create([
            'student_id' => $mahasiswa->id,
            'counselor_id' => $konselor->id,
            'topic' => 'Kesulitan mengatur waktu',
            'description' => 'Saya sering kesulitan membagi waktu antara kuliah dan organisasi',
            'consultation_date' => now()->addDays(5)->setHour(10)->setMinute(0),
            'status' => 'approved',
        ]);

        // Sample artikel
        Article::create([
            'user_id' => $konselor->id,
            'title' => 'Cara Mengelola Stres saat Ujian',
            'category' => 'kesehatan',
            'content' => 'Stres saat ujian adalah hal yang wajar dialami oleh setiap mahasiswa. Namun, jika tidak dikelola dengan baik, stres dapat berdampak negatif pada performa akademik dan kesehatan mental. Berikut beberapa tips yang bisa kamu coba: 1. Buat jadwal belajar yang teratur, 2. Istirahat yang cukup, 3. Lakukan teknik pernapasan saat merasa cemas, 4. Jangan ragu untuk berbicara dengan teman atau konselor.',
        ]);

        Article::create([
            'user_id' => $konselor->id,
            'title' => 'Pentingnya Self-Care untuk Mahasiswa',
            'category' => 'motivasi',
            'content' => 'Self-care bukanlah hal yang egois. Sebagai mahasiswa, kamu perlu merawat diri sendiri agar bisa berfungsi optimal. Mulailah dengan hal-hal sederhana seperti tidur cukup, makan teratur, olahraga ringan, dan meluangkan waktu untuk hobi. Ingatlah bahwa kesehatan mental sama pentingnya dengan nilai akademik.',
        ]);

        // Sample postingan komunitas
        $post1 = Community::create([
            'user_id' => $mahasiswa->id,
            'title' => 'Tips Belajar Efektif ala Mahasiswa',
            'content' => 'Hai teman-teman! Aku mau berbagi tips belajar yang efektif selama di kuliah. Pertama, coba gunakan teknik Pomodoro (25 menit fokus, 5 menit istirahat). Kedua, catat materi dengan mind map biar lebih mudah diingat. Ketiga, jangan lupa reward diri sendiri setelah belajar! Kalian punya tips lain? Share di sini ya!',
            'category' => 'tips',
        ]);

        $post2 = Community::create([
            'user_id' => $konselor->id,
            'title' => 'Open Discussion: Kesehatan Mental di Kampus',
            'content' => 'Mari kita diskusikan tentang kesehatan mental di lingkungan kampus. Menurut kalian, apa tantangan terbesar dalam menjaga kesehatan mental sebagai mahasiswa? Dan apa yang bisa dilakukan kampus untuk mendukung mahasiswa?',
            'category' => 'kesehatan',
        ]);

        // Sample komentar
        Comment::create([
            'community_id' => $post1->id,
            'user_id' => $konselor->id,
            'comment' => 'Tips yang bagus! Saya juga merekomendasikan untuk membuat study group agar belajar lebih menyenangkan.',
        ]);

        Comment::create([
            'community_id' => $post2->id,
            'user_id' => $mahasiswa->id,
            'comment' => 'Menurut saya tantangan terbesar adalah stigma yang masih melekat pada isu kesehatan mental. Banyak mahasiswa yang enggan mencari bantuan karena takut dianggap lemah.',
        ]);

        // Sample materi
        Material::create([
            'user_id' => $konselor->id,
            'title' => 'Panduan Manajemen Waktu untuk Mahasiswa',
            'category' => 'produktivitas',
            'description' => 'Dokumen lengkap tentang teknik manajemen waktu yang efektif untuk membantu mahasiswa mengatur jadwal kuliah, tugas, dan kegiatan organisasi.',
        ]);

        Material::create([
            'user_id' => $konselor->id,
            'title' => 'Modul Relaksasi dan Mindfulness',
            'category' => 'kesehatan',
            'description' => 'Panduan praktis teknik relaksasi dan mindfulness yang bisa dilakukan sehari-hari untuk mengurangi stres dan kecemasan.',
        ]);

        $this->call(NotificationSeeder::class);
    }
}
