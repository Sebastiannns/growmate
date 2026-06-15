<?php

// Controller: CommunityController — handle forum diskusi (comun.png, detil comun.png)
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    // Tampilkan daftar postingan forum
    public function index()
    {
        $posts = Community::with('user', 'comments')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('community.index', compact('posts'));
    }

    // Tampilkan detail postingan
    public function show(Community $post)
    {
        $post->load('user', 'comments.user');
        return view('community.show', compact('post'));
    }

    // Simpan postingan baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:50'],
        ]);

        Community::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
        ]);

        return redirect()->route('community.index')->with('success', 'Postingan berhasil dibuat!');
    }

    // Simpan komentar
    public function comment(Request $request, Community $post)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        Comment::create([
            'community_id' => $post->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('community.show', $post)->with('success', 'Komentar ditambahkan!');
    }
}
