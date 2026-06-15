{{-- GrowMate: Counselor Schedule — jadwal konsultasi (jadwal konsultasi.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="page-header">
            <div class="flex items-center gap-3">
                <a href="{{ route('counselor.dashboard') }}" class="text-soft-text hover:text-black transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <p class="text-sm text-soft-text">Jadwal Konsultasi</p>
                    <h1>Kelola sesi konsultasi</h1>
                </div>
            </div>
        </div>

        <div class="flex gap-2 overflow-x-auto pb-2 mb-6 scrollbar-hide">
            <a href="{{ route('counselor.schedule') }}"
               class="px-4 py-2 rounded-xl text-[11px] lg:text-xs font-medium whitespace-nowrap transition-all duration-200
                      {{ $currentFilter === 'all' ? 'bg-primary text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200' }}">
                Semua
            </a>
            <a href="{{ route('counselor.schedule', ['status' => 'pending']) }}"
               class="px-4 py-2 rounded-xl text-[11px] lg:text-xs font-medium whitespace-nowrap transition-all duration-200
                      {{ $currentFilter === 'pending' ? 'bg-yellow-400 text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200' }}">
                Menunggu
            </a>
            <a href="{{ route('counselor.schedule', ['status' => 'approved']) }}"
               class="px-4 py-2 rounded-xl text-[11px] lg:text-xs font-medium whitespace-nowrap transition-all duration-200
                      {{ $currentFilter === 'approved' ? 'bg-green-400 text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200' }}">
                Disetujui
            </a>
            <a href="{{ route('counselor.schedule', ['status' => 'completed']) }}"
               class="px-4 py-2 rounded-xl text-[11px] lg:text-xs font-medium whitespace-nowrap transition-all duration-200
                      {{ $currentFilter === 'completed' ? 'bg-primary text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200' }}">
                Selesai
            </a>
            <a href="{{ route('counselor.schedule', ['status' => 'cancelled']) }}"
               class="px-4 py-2 rounded-xl text-[11px] lg:text-xs font-medium whitespace-nowrap transition-all duration-200
                      {{ $currentFilter === 'cancelled' ? 'bg-red-400 text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200' }}">
                Dibatalkan
            </a>
        </div>

        @if($consultations->count() > 0)
            <div class="space-y-3">
                @foreach($consultations as $cons)
                    <div class="stat-card border-l-4
                        @if($cons->status === 'approved') border-green-400
                        @elseif($cons->status === 'completed') border-primary
                        @elseif($cons->status === 'cancelled') border-red-400
                        @else border-yellow-400
                        @endif">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-[15px] font-semibold">{{ $cons->student->name }}</h3>
                                <p class="text-[11px] text-soft-text">{{ $cons->topic }}</p>
                            </div>
                            <span class="growmate-badge flex-shrink-0 ml-2
                                @if($cons->status === 'approved') bg-green-100 text-green-600
                                @elseif($cons->status === 'completed') bg-primary/10 text-primary
                                @elseif($cons->status === 'cancelled') bg-red-100 text-red-500
                                @else bg-yellow-100 text-yellow-600
                                @endif">
                                {{ ucfirst($cons->status) }}
                            </span>
                        </div>
                        @if($cons->description)
                            <p class="text-[11px] text-black/70 mb-2">{{ $cons->description }}</p>
                        @endif
                        <div class="flex items-center gap-2 text-[10px] text-soft-text mb-3">
                            <span>📅 {{ \Carbon\Carbon::parse($cons->consultation_date)->format('d M Y H:i') }}</span>
                        </div>
                        @if($cons->notes)
                            <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                <p class="text-[10px] font-medium text-label mb-1">Catatan:</p>
                                <p class="text-[11px] text-black/70">{{ $cons->notes }}</p>
                            </div>
                        @endif

                        @if($cons->status === 'pending')
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('counselor.update-consultation', $cons) }}" class="flex-1">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="w-full py-2 bg-green-100 text-green-600 text-[10px] font-semibold rounded-lg hover:bg-green-200 transition-colors">Setujui</button>
                                </form>
                                <form method="POST" action="{{ route('counselor.update-consultation', $cons) }}" class="flex-1">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="w-full py-2 bg-red-100 text-red-500 text-[10px] font-semibold rounded-lg hover:bg-red-200 transition-colors">Tolak</button>
                                </form>
                            </div>
                        @endif

                        @if($cons->status === 'approved')
                            <div x-data="{ showNote: false }">
                                <button @click="showNote = !showNote" class="text-[10px] text-primary font-semibold hover:underline">+ Tambah Catatan & Selesaikan</button>
                                <form method="POST" action="{{ route('counselor.update-consultation', $cons) }}" x-show="showNote" x-transition.duration.200ms class="mt-2 space-y-2">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <textarea name="notes" placeholder="Catatan konsultasi..." class="growmate-input min-h-[80px] resize-none text-[11px]" required></textarea>
                                    <button type="submit" class="growmate-btn-primary h-[36px] text-[10px]">Selesaikan & Simpan</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📋</div>
                <p class="empty-state-title">
                    @if($currentFilter === 'all')
                        Belum ada sesi konsultasi
                    @else
                        Tidak ada sesi dengan status "{{ $currentFilter }}"
                    @endif
                </p>
            </div>
        @endif
    </div>
</x-app-layout>
