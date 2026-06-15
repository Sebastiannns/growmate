{{-- GrowMate: Counselor Edit Article --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('counselor.articles') }}" class="text-soft-text hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-black">Edit Artikel</h1>
                <p class="text-[13px] text-soft-text">{{ $article->title }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('counselor.articles.update', $article) }}" enctype="multipart/form-data" class="bg-white rounded-2xl p-4 shadow-card space-y-3">
            @csrf
            @method('PATCH')
            <div>
                <label class="text-[11px] font-medium text-label block mb-1.5">Judul Artikel</label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}" class="growmate-input" required>
            </div>
            <div>
                <label class="text-[11px] font-medium text-label block mb-1.5">Kategori</label>
                <select name="category" class="growmate-input">
                    <option value="">Umum</option>
                    @foreach(['kesehatan'=>'Kesehatan Mental','motivasi'=>'Motivasi','tips'=>'Tips Belajar','produktivitas'=>'Produktivitas','relasi'=>'Relasi & Sosial'] as $val=>$label)
                        <option value="{{ $val }}" @selected(old('category', $article->category) === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-[11px] font-medium text-label block mb-1.5">Konten</label>
                <textarea name="content" class="growmate-input min-h-[200px] resize-none" required>{{ old('content', $article->content) }}</textarea>
            </div>
            <div>
                <label class="text-[11px] font-medium text-label block mb-1.5">Gambar</label>
                <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/gif" class="growmate-input">
                @if($article->image_path)
                    <p class="text-[10px] text-soft-text mt-1">Biarkan kosong jika tidak ingin mengubah gambar</p>
                @endif
            </div>
            <div class="flex gap-3">
                <a href="{{ route('counselor.articles') }}" class="growmate-btn-secondary h-[46px] flex-1 text-center leading-[46px] text-[13px]">Batal</a>
                <button type="submit" class="growmate-btn-primary h-[46px] flex-1 text-[13px]">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
