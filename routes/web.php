<?php

// GrowMate Routes — semua route aplikasi
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\CounselorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TimerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes (tanpa login)
|--------------------------------------------------------------------------
*/

// Landing page (halaman awal.png)
Route::get('/', function () {
    return view('welcome');
});

// Opsi role (opsi.png) — pilih Mahasiswa/Konselor
Route::get('/options', [AuthController::class, 'showOptions'])->name('options');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Breeze + custom)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

// Personal data setelah register (data pribadi.png) — khusus student
Route::middleware(['auth'])->group(function () {
    Route::get('/personal-data', [AuthController::class, 'showPersonalData'])
        ->name('personal-data');
    Route::post('/personal-data', [AuthController::class, 'storePersonalData'])
        ->name('personal-data.store');

    // OTP verification (otp.png)
    Route::get('/verify-otp', [AuthController::class, 'showOtp'])
        ->name('otp.show');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])
        ->name('otp.verify');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (semua role)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Dashboard (beranda.png) — landing page setelah login
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mood Tracker (Phase 2)
    Route::get('/mood', [MoodController::class, 'index'])->name('mood.index');
    Route::post('/mood', [MoodController::class, 'store'])->name('mood.store');

    // Task Management (Phase 2)
    Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('task.destroy');

    // Focus Timer (Phase 2)
    Route::get('/timer', [TimerController::class, 'index'])->name('timer.index');
    Route::post('/timer/save', [TimerController::class, 'store'])->name('timer.store');

    // Community Forum (Phase 3)
    Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
    Route::get('/community/{post}', [CommunityController::class, 'show'])->name('community.show');
    Route::post('/community', [CommunityController::class, 'store'])->name('community.store');
    Route::post('/community/{post}/comment', [CommunityController::class, 'comment'])->name('community.comment');

    // Consultation (Phase 3)
    Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation.index');
    Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');
    Route::patch('/consultation/{consultation}', [ConsultationController::class, 'update'])->name('consultation.update');

    // Study Materials (Phase 3)
    Route::get('/materials', [MaterialController::class, 'index'])->name('material.index');
    Route::get('/materials/category/{category}', [MaterialController::class, 'category'])->name('material.category');

    // AI Chat (Phase 4)
    Route::get('/ai-chat', [AIChatController::class, 'index'])->name('ai-chat.index');
    Route::post('/ai-chat', [AIChatController::class, 'send'])->name('ai-chat.send');

    // Notifications (Phase 4)
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notification.index');
    Route::get('/notifications/read/{notification}', [NotificationController::class, 'read'])->name('notification.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notification.readAll');

    // Analytics (Phase 4)
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
});

// Counselor-only routes (Phase 5)
Route::middleware(['auth', 'role:counselor'])->prefix('counselor')->name('counselor.')->group(function () {
    Route::get('/dashboard', [CounselorController::class, 'dashboard'])->name('dashboard');
    Route::get('/schedule', [CounselorController::class, 'schedule'])->name('schedule');
    Route::patch('/consultation/{consultation}', [CounselorController::class, 'updateConsultation'])->name('update-consultation');
    Route::get('/articles', [CounselorController::class, 'articles'])->name('articles');
    Route::post('/articles', [CounselorController::class, 'storeArticle'])->name('articles.store');
    Route::get('/articles/{article}/edit', [CounselorController::class, 'editArticle'])->name('articles.edit');
    Route::patch('/articles/{article}', [CounselorController::class, 'updateArticle'])->name('articles.update');
    Route::delete('/articles/{article}', [CounselorController::class, 'destroyArticle'])->name('articles.destroy');
});

// Admin-only routes (Phase 5)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::patch('/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('users.role');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/community', [AdminController::class, 'community'])->name('community');
    Route::delete('/community/{post}', [AdminController::class, 'destroyPost'])->name('community.destroy');
    Route::delete('/community/comment/{comment}', [AdminController::class, 'destroyComment'])->name('community.comment.destroy');
    Route::get('/materials', [AdminController::class, 'materials'])->name('materials');
    Route::post('/materials', [AdminController::class, 'storeMaterial'])->name('materials.store');
    Route::get('/materials/{material}/edit', [AdminController::class, 'editMaterial'])->name('materials.edit');
    Route::patch('/materials/{material}', [AdminController::class, 'updateMaterial'])->name('materials.update');
    Route::delete('/materials/{material}', [AdminController::class, 'destroyMaterial'])->name('materials.destroy');
});
