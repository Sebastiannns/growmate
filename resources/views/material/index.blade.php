{{-- GrowMate: Materi Belajar (Materi belajar.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="page-header">
            <div>
                <p class="text-sm text-soft-text">Materi Belajar</p>
                <h1>Sumber belajar untukmu</h1>
            </div>
        </div>

        <div class="flex gap-2 overflow-x-auto pb-2 mb-6 scrollbar-hide">
            <a href="{{ route('material.index') }}"
               class="px-4 py-2 rounded-xl text-[11px] lg:text-xs font-medium whitespace-nowrap transition-all duration-200
                      {{ !isset($category) ? 'bg-primary text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200' }}">
                Semua
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('material.category', $cat) }}"
                   class="px-4 py-2 rounded-xl text-[11px] lg:text-xs font-medium whitespace-nowrap transition-all duration-200
                          {{ (isset($category) && $category === $cat) ? 'bg-primary text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200' }}">
                    {{ ucfirst($cat) }}
                </a>
            @endforeach
        </div>

        @if($materials->count() > 0)
            <div class="space-y-3">
                @foreach($materials as $material)
                    <div class="stat-card hover:shadow-lg transition-all duration-200">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                                <span class="text-lg">📖</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-[15px] font-semibold">{{ $material->title }}</h3>
                                @if($material->description)
                                    <p class="text-[12px] text-soft-text mt-1 line-clamp-2">{{ $material->description }}</p>
                                @endif
                                <div class="flex items-center gap-2 mt-2">
                                    @if($material->category)
                                        <span class="growmate-badge bg-accent/10 text-accent-dark">{{ $material->category }}</span>
                                    @endif
                                    <span class="text-[10px] text-soft-text">{{ $material->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            @if($material->file_path)
                                <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank"
                                   class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 hover:bg-primary/20 transition-colors">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📚</div>
                <p class="empty-state-title">Belum ada materi belajar</p>
                <p class="empty-state-desc">Materi akan ditambahkan oleh konselor</p>
            </div>
        @endif
    </div>
</x-app-layout>
