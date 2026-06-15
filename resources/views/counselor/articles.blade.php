{{-- GrowMate: Counselor Articles — publikasi artikel kesehatan mental --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="page-header">
            <div class="flex items-center gap-3">
                <a href="{{ route('counselor.dashboard') }}" class="text-soft-text hover:text-black transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <p class="text-sm text-soft-text">Artikel</p>
                    <h1>Publikasi artikel kesehatan mental</h1>
                    <p class="text-[11px] text-soft-text mt-1">Bagikan artikel edukatif untuk membantu mahasiswa.</p>
                </div>
            </div>
        </div>

        <div x-data="{ open: false }" class="mb-6">
                <button @click="open = !open" class="growmate-btn-primary h-[46px] mb-3">
                    <span x-text="open ? '- Tutup' : '+ Buat Artikel Baru'">+ Buat Artikel Baru</span>
                </button>

            <form method="POST" action="{{ route('counselor.articles.store') }}" x-show="open" x-transition.duration.200ms enctype="multipart/form-data" class="stat-card space-y-3">
                @csrf
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Judul Artikel</label>
                    <input type="text" name="title" placeholder="Judul artikel" class="growmate-input" required>
                </div>
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Kategori</label>
                    <select name="category" class="growmate-input">
                        <option value="">Umum</option>
                        <option value="kesehatan">Kesehatan Mental</option>
                        <option value="motivasi">Motivasi</option>
                        <option value="tips">Tips Belajar</option>
                        <option value="produktivitas">Produktivitas</option>
                        <option value="relasi">Relasi & Sosial</option>
                    </select>
                </div>
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Konten</label>
                    <textarea name="content" placeholder="Tulis artikel..." class="growmate-input min-h-[200px] resize-none" required></textarea>
                </div>
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Gambar (opsional)</label>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/gif" class="growmate-input">
                </div>
                <button type="submit" class="growmate-btn-primary h-[46px]">Publikasikan</button>
            </form>
        </div>

        @if($articles->count() > 0)
            <div class="space-y-3">
                @foreach($articles as $article)
                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-[15px] font-semibold">{{ $article->title }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    @if($article->category)
                                        <span class="growmate-badge bg-accent/10 text-accent-dark">{{ $article->category }}</span>
                                    @endif
                                    <span class="text-[10px] text-soft-text">{{ $article->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0 ml-2">
                                <a href="{{ route('counselor.articles.edit', $article) }}" class="w-8 h-8 rounded-lg bg-accent/10 text-accent-dark flex items-center justify-center hover:bg-accent/20 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('counselor.articles.destroy', $article) }}" onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-400 flex items-center justify-center hover:bg-red-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="text-[12px] text-black/70 line-clamp-3">{{ $article->content }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📝</div>
                <p class="empty-state-title">Belum ada artikel</p>
                <p class="empty-state-desc">Publikasikan artikel pertamamu untuk membantu mahasiswa!</p>
            </div>
        @endif
    </div>
</x-app-layout>
