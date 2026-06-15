{{-- GrowMate: Admin Materials — manajemen materi belajar --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.dashboard') }}" class="text-soft-text hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-black">Materi Belajar</h1>
                <p class="text-[13px] text-soft-text">Kelola materi belajar platform</p>
            </div>
        </div>

        {{-- Form Materi Baru --}}
        <div x-data="{ open: false }" class="mb-6">
            <p class="text-[11px] text-soft-text mb-3">Tambahkan materi belajar untuk mahasiswa.</p>
            <button @click="open = !open"
                    class="growmate-btn-primary h-[46px] mb-3">
                <span x-text="open ? '− Tutup' : '+ Tambah Materi Baru'">+ Tambah Materi Baru</span>
            </button>

            <form method="POST" action="{{ route('admin.materials.store') }}" x-show="open" x-transition.duration.200ms enctype="multipart/form-data" class="bg-white rounded-2xl p-4 shadow-card space-y-3">
                @csrf
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Judul Materi</label>
                    <input type="text" name="title" placeholder="Judul materi" class="growmate-input" required>
                </div>
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Kategori</label>
                    <select name="category" class="growmate-input">
                        <option value="">Umum</option>
                        <option value="akademik">Akademik</option>
                        <option value="kesehatan">Kesehatan Mental</option>
                        <option value="tips">Tips Belajar</option>
                        <option value="produktivitas">Produktivitas</option>
                        <option value="karier">Karier</option>
                    </select>
                </div>
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Deskripsi</label>
                    <textarea name="description" placeholder="Deskripsi materi..." class="growmate-input min-h-[100px] resize-none"></textarea>
                </div>
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">File (opsional)</label>
                    <input type="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.txt" class="growmate-input">
                </div>
                <button type="submit" class="growmate-btn-primary h-[46px]">Simpan</button>
            </form>
        </div>

        {{-- Daftar Materi --}}
        @if($materials->count() > 0)
            <div class="space-y-3">
                @foreach($materials as $material)
                    <div class="bg-white rounded-2xl p-4 shadow-card">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                                <span class="text-lg">📖</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-[15px] font-semibold">{{ $material->title }}</h3>
                                        @if($material->description)
                                            <p class="text-[12px] text-soft-text mt-1 line-clamp-2">{{ $material->description }}</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-2 ml-2">
                                        <a href="{{ route('admin.materials.edit', $material) }}" class="w-8 h-8 rounded-lg bg-accent/10 text-accent-dark flex items-center justify-center hover:bg-accent/20 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.materials.destroy', $material) }}" onsubmit="return confirm('Hapus materi ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-400 flex items-center justify-center hover:bg-red-100 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-2">
                                    @if($material->category)
                                        <span class="growmate-badge bg-accent/10 text-accent-dark">{{ $material->category }}</span>
                                    @endif
                                    <span class="text-[10px] text-soft-text">oleh {{ $material->user->name ?? 'Admin' }}</span>
                                    <span class="text-[10px] text-soft-text">{{ $material->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-10">
                <span class="text-4xl">📚</span>
                <p class="text-[13px] text-soft-text mt-3">Belum ada materi belajar</p>
                <p class="text-[10px] text-soft-text">Tambahkan materi untuk membantu mahasiswa!</p>
            </div>
        @endif
    </div>
</x-app-layout>
