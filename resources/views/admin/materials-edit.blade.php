{{-- GrowMate: Admin Edit Material --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.materials') }}" class="text-soft-text hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-black">Edit Materi</h1>
                <p class="text-[13px] text-soft-text">{{ $material->title }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.materials.update', $material) }}" enctype="multipart/form-data" class="bg-white rounded-2xl p-4 shadow-card space-y-3">
            @csrf
            @method('PATCH')
            <div>
                <label class="text-[11px] font-medium text-label block mb-1.5">Judul Materi</label>
                <input type="text" name="title" value="{{ old('title', $material->title) }}" class="growmate-input" required>
            </div>
            <div>
                <label class="text-[11px] font-medium text-label block mb-1.5">Kategori</label>
                <select name="category" class="growmate-input">
                    <option value="">Umum</option>
                    @foreach(['akademik'=>'Akademik','kesehatan'=>'Kesehatan Mental','tips'=>'Tips Belajar','produktivitas'=>'Produktivitas','karier'=>'Karier'] as $val=>$label)
                        <option value="{{ $val }}" @selected(old('category', $material->category) === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-[11px] font-medium text-label block mb-1.5">Deskripsi</label>
                <textarea name="description" class="growmate-input min-h-[100px] resize-none">{{ old('description', $material->description) }}</textarea>
            </div>
            <div>
                <label class="text-[11px] font-medium text-label block mb-1.5">File</label>
                <input type="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.txt" class="growmate-input">
                @if($material->file_path)
                    <p class="text-[10px] text-soft-text mt-1">Biarkan kosong jika tidak ingin mengubah file</p>
                @endif
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.materials') }}" class="growmate-btn-secondary h-[46px] flex-1 text-center leading-[46px] text-[13px]">Batal</a>
                <button type="submit" class="growmate-btn-primary h-[46px] flex-1 text-[13px]">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
