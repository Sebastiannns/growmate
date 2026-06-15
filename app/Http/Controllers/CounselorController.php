<?php

// Controller: CounselorController — dashboard & fitur khusus konselor
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Consultation;
use Illuminate\Http\Request;

class CounselorController extends Controller
{
    // Dashboard konselor — ringkasan jadwal & aktivitas
    public function dashboard()
    {
        $user = auth()->user();

        $todayConsultations = Consultation::with('student')
            ->where('counselor_id', $user->id)
            ->whereDate('consultation_date', now()->today())
            ->orderBy('consultation_date', 'asc')
            ->get();

        $pendingCount = Consultation::where('counselor_id', $user->id)
            ->where('status', 'pending')->count();

        $activeCount = Consultation::where('counselor_id', $user->id)
            ->where('status', 'approved')->count();

        $completedCount = Consultation::where('counselor_id', $user->id)
            ->where('status', 'completed')->count();

        $articles = Article::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentConsultations = Consultation::with('student')
            ->where('counselor_id', $user->id)
            ->orderBy('consultation_date', 'desc')
            ->limit(5)
            ->get();

        return view('counselor.dashboard', compact(
            'todayConsultations', 'pendingCount', 'activeCount',
            'completedCount', 'articles', 'recentConsultations'
        ));
    }

    // Jadwal konsultasi (filter by status)
    public function schedule(Request $request)
    {
        $query = Consultation::with('student')
            ->where('counselor_id', auth()->id());

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $consultations = $query->orderBy('consultation_date', 'desc')->get();
        $currentFilter = $request->status ?? 'all';

        return view('counselor.schedule', compact('consultations', 'currentFilter'));
    }

    // Update status + notes konsultasi
    public function updateConsultation(Request $request, Consultation $consultation)
    {
        if ($consultation->counselor_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => ['required', 'in:approved,completed,cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        $consultation->update($request->only(['status', 'notes']));

        return redirect()->route('counselor.schedule')
            ->with('success', 'Status konsultasi diperbarui!');
    }

    // Daftar artikel konselor
    public function articles()
    {
        $articles = Article::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('counselor.articles', compact('articles'));
    }

    // Simpan artikel baru
    public function storeArticle(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:50'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $data = [
            'user_id' => auth()->id(),
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('counselor.articles')
            ->with('success', 'Artikel berhasil dipublikasikan!');
    }

    // Edit artikel
    public function editArticle(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        return view('counselor.articles-edit', compact('article'));
    }

    // Update artikel
    public function updateArticle(Request $request, Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:50'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $data = $request->only(['title', 'category', 'content']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $data['image_path'] = $path;
        }

        $article->update($data);

        return redirect()->route('counselor.articles')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    // Hapus artikel
    public function destroyArticle(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        $article->delete();
        return redirect()->route('counselor.articles')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}
