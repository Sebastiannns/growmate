{{-- GrowMate: Community Forum (comun.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="page-header">
            <div>
                <p class="text-sm text-soft-text">Komunitas</p>
                <h1>Diskusi dan berbagi cerita</h1>
                <p class="text-[11px] text-soft-text mt-1">Tanya, curhat, atau berbagi tips dengan sesama mahasiswa.</p>
            </div>
        </div>

        <div x-data="{ open: false }" class="mb-6">
            <button @click="open = !open" class="growmate-btn-primary h-[46px] mb-3">
                <span x-text="open ? '− Tutup' : '+ Buat Postingan'">+ Buat Postingan</span>
            </button>

            <form method="POST" action="{{ route('community.store') }}" x-show="open" x-transition.duration.200ms class="stat-card space-y-3">
                @csrf
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Judul</label>
                    <input type="text" name="title" placeholder="Judul postingan" class="growmate-input" required>
                </div>
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Kategori</label>
                    <select name="category" class="growmate-input">
                        <option value="">Umum</option>
                        <option value="akademik">Akademik</option>
                        <option value="kesehatan">Kesehatan Mental</option>
                        <option value="tips">Tips Belajar</option>
                        <option value="curhat">Curhat</option>
                        <option value="event">Event</option>
                    </select>
                </div>
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Konten</label>
                    <textarea name="content" placeholder="Tulis cerita atau pertanyaanmu..." class="growmate-input min-h-[120px] resize-none" required></textarea>
                </div>
                <button type="submit" class="growmate-btn-primary h-[46px]">Publikasikan</button>
            </form>
        </div>

        @if($posts->count() > 0)
            <div class="space-y-3">
                @foreach($posts as $post)
                    <a href="{{ route('community.show', $post) }}" class="block stat-card hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white font-bold text-xs flex-shrink-0 shadow-sm">
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
                        <h3 class="text-[15px] font-semibold mb-1">{{ $post->title }}</h3>
                        <p class="text-[13px] text-soft-text line-clamp-2">{{ $post->content }}</p>
                        <div class="flex items-center gap-3 mt-3 text-[10px] text-soft-text">
                            <span>💬 {{ $post->comments->count() }} komentar</span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">💬</div>
                <p class="empty-state-title">Belum ada diskusi</p>
                <p class="empty-state-desc">Jadilah yang pertama berbagi!</p>
            </div>
        @endif
    </div>
</x-app-layout>
