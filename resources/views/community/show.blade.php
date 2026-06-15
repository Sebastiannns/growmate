{{-- GrowMate: Detail Postingan Komunitas (detil comun.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        {{-- Back --}}
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('community.index') }}" class="text-soft-text hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-xl font-bold text-black">Diskusi</h1>
        </div>

        {{-- Postingan --}}
        <div class="bg-white rounded-2xl p-4 shadow-card mb-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs flex-shrink-0">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-[13px] font-medium">{{ $post->user->name }}</p>
                    <p class="text-[10px] text-soft-text">{{ $post->created_at->diffForHumans() }}</p>
                </div>
                @if($post->category)
                    <span class="growmate-badge bg-primary/10 text-primary ml-auto">{{ $post->category }}</span>
                @endif
            </div>
            <h2 class="text-[15px] font-semibold mb-2">{{ $post->title }}</h2>
            <p class="text-[13px] text-black/70 leading-relaxed">{{ $post->content }}</p>
        </div>

        {{-- Form Komentar --}}
        <form method="POST" action="{{ route('community.comment', $post) }}" class="bg-white rounded-2xl p-4 shadow-card mb-4">
            @csrf
            <label class="text-[11px] font-medium text-label block mb-1.5">Tulis komentar</label>
            <div class="flex gap-2">
                <input type="text" name="comment" placeholder="Ketik komentar..." class="growmate-input flex-1" required>
                <button type="submit" class="w-[46px] h-[46px] rounded-xl bg-primary text-white flex items-center justify-center flex-shrink-0 hover:bg-primary-dark transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19V5m0 0l-7 7m7-7l7 7"/></svg>
                </button>
            </div>
        </form>

        {{-- Daftar Komentar --}}
        <div class="space-y-2">
            @forelse($post->comments->sortByDesc('created_at') as $comment)
                <div class="bg-white rounded-xl p-3 shadow-sm border border-border/50">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-[8px] font-bold text-soft-text">
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        </div>
                        <p class="text-[11px] font-medium">{{ $comment->user->name }}</p>
                        <p class="text-[9px] text-soft-text ml-auto">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    <p class="text-[12px] text-black/70 ml-8">{{ $comment->comment }}</p>
                </div>
            @empty
                <div class="text-center py-6">
                    <p class="text-[13px] text-soft-text">Belum ada komentar</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
