<?php

// Controller: AdminController — dashboard & manajemen platform
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Community;
use App\Models\Consultation;
use App\Models\Material;
use App\Models\MoodLog;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard admin — ringkasan platform
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalStudents = User::where('role', 'student')->count();
        $totalCounselors = User::where('role', 'counselor')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalConsultations = Consultation::count();
        $totalPosts = Community::count();
        $totalMaterials = Material::count();
        $totalMoods = MoodLog::count();

        $pendingConsultations = Consultation::where('status', 'pending')->count();
        $recentUsers = User::orderBy('created_at', 'desc')->limit(5)->get();
        $recentPosts = Community::with('user')->orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalStudents', 'totalCounselors', 'totalAdmins',
            'totalConsultations', 'totalPosts', 'totalMaterials',
            'totalMoods', 'pendingConsultations', 'recentUsers', 'recentPosts'
        ));
    }

    // Manajemen user
    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);
        $currentRole = $request->role ?? 'all';

        return view('admin.users', compact('users', 'currentRole'));
    }

    // Edit role user
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'in:student,counselor,admin'],
        ]);

        if ($user->role === 'admin' && $user->id !== auth()->id()) {
            return back()->with('error', 'Tidak bisa mengubah role admin lain!');
        }

        $user->update(['role' => $request->role]);

        return redirect()->route('admin.users')
            ->with('success', 'Role user berhasil diperbarui!');
    }

    // Hapus user
    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak bisa menghapus admin lain!');
        }

        $user->delete();
        return redirect()->route('admin.users')
            ->with('success', 'User berhasil dihapus!');
    }

    // Moderasi komunitas — daftar postingan
    public function community()
    {
        $posts = Community::with('user', 'comments.user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.community', compact('posts'));
    }

    // Hapus postingan komunitas
    public function destroyPost(Community $post)
    {
        $post->delete();
        return redirect()->route('admin.community')
            ->with('success', 'Postingan berhasil dihapus!');
    }

    // Hapus komentar
    public function destroyComment(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.community')
            ->with('success', 'Komentar berhasil dihapus!');
    }

    // Manajemen materi
    public function materials()
    {
        $materials = Material::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.materials', compact('materials'));
    }

    // Simpan materi baru
    public function storeMaterial(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,txt', 'max:10240'],
        ]);

        $data = [
            'user_id' => auth()->id(),
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
        ];

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('materials', 'public');
        }

        Material::create($data);

        return redirect()->route('admin.materials')
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    // Edit materi
    public function editMaterial(Material $material)
    {
        return view('admin.materials-edit', compact('material'));
    }

    // Update materi
    public function updateMaterial(Request $request, Material $material)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,txt', 'max:10240'],
        ]);

        $data = $request->only(['title', 'category', 'description']);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('materials', 'public');
        }

        $material->update($data);

        return redirect()->route('admin.materials')
            ->with('success', 'Materi berhasil diperbarui!');
    }

    // Hapus materi
    public function destroyMaterial(Material $material)
    {
        $material->delete();
        return redirect()->route('admin.materials')
            ->with('success', 'Materi berhasil dihapus!');
    }
}
