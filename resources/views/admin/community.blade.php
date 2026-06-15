{{-- GrowMate: Admin Community — moderasi postingan forum --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.dashboard') }}" class="text-soft-text hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-black">Moderasi Komunitas</h1>
                <p class="text-[13px] text-soft-text">Kelola postingan dan komentar</p>
            </div>
        </div>

        @if($posts->count() > 0)
            <div class="space-y-4">
                @foreach($posts as $post)
                    <div class="bg-white rounded-2xl p-4 shadow-card">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs flex-shrink-0">
                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[13px] font-medium">{{ $post->user->name }}</p>
                                <p class="text-[10px] text-soft-text">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                            @if($post->category)
                                <span class="growmate-badge bg-primary/10 text-primary">{{ $post->category }}</span>
                            @endif
                            <form method="POST" action="{{ route('admin.community.destroy', $post) }}" onsubmit="return confirm('Hapus postingan ini? Semua komentar juga akan dihapus.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-400 flex items-center justify-center hover:bg-red-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                        <h3 class="text-[15px] font-semibold mb-1">{{ $post->title }}</h3>
                        <p class="text-[12px] text-black/70 line-clamp-2 mb-3">{{ $post->content }}</p>

                        {{-- Comments --}}
                        @if($post->comments->count() > 0)
                            <div class="border-t border-border/50 pt-3 space-y-2">
                                <p class="text-[10px] font-medium text-label">{{ $post->comments->count() }} komentar</p>
                                @foreach($post->comments as $comment)
                                    <div class="flex items-start justify-between gap-2 bg-gray-50 rounded-lg p-2">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-[10px] font-medium">{{ $comment->user->name }}</span>
                                                <span class="text-[8px] text-soft-text">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-[11px] text-black/70">{{ $comment->comment }}</p>
                                        </div>
                                        <form method="POST" action="{{ route('admin.community.comment.destroy', $comment) }}" onsubmit="return confirm('Hapus komentar ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-6 h-6 rounded bg-red-50 text-red-400 flex items-center justify-center hover:bg-red-100 flex-shrink-0">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-10">
                    <span class="text-4xl">💬</span>
                    <p class="text-[13px] text-soft-text mt-3">Belum ada postingan</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
