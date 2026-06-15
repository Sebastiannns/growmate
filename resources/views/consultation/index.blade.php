{{-- GrowMate: Konsultasi (konsul.png, jadwal konsultasi.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="page-header">
            <div>
                <p class="text-sm text-soft-text">Konsultasi</p>
                <h1>
                    @if(auth()->user()->role === 'counselor')
                        Kelola sesi konsultasi
                    @else
                        Booking sesi dengan konselor
                    @endif
                </h1>
                <p class="text-[11px] text-soft-text mt-1">
                    @if(auth()->user()->role === 'counselor')
                        Kelola dan pantau sesi konsultasi dengan mahasiswa.
                    @else
                        Jadwalkan sesi konsultasi pribadi dengan konselor profesional.
                    @endif
                </p>
            </div>
        </div>

        @if(auth()->user()->role !== 'counselor')
            <div x-data="{ open: false }" class="mb-6">
                <button @click="open = !open" class="growmate-btn-primary h-[46px] mb-3">
                    <span x-text="open ? '− Tutup' : '+ Booking Konsultasi'">+ Booking Konsultasi</span>
                </button>

                <form method="POST" action="{{ route('consultation.store') }}" x-show="open" x-transition.duration.200ms class="stat-card space-y-3">
                    @csrf
                    <div>
                        <label class="text-[11px] font-medium text-label block mb-1.5">Pilih Konselor</label>
                        <select name="counselor_id" class="growmate-input" required>
                            <option value="">Pilih konselor</option>
                            @foreach($counselors as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-[11px] font-medium text-label block mb-1.5">Topik</label>
                        <input type="text" name="topic" placeholder="Topik konsultasi" class="growmate-input" required>
                    </div>
                    <div>
                        <label class="text-[11px] font-medium text-label block mb-1.5">Deskripsi (opsional)</label>
                        <textarea name="description" placeholder="Ceritakan yang kamu rasakan..." class="growmate-input min-h-[80px] resize-none"></textarea>
                    </div>
                    <div>
                        <label class="text-[11px] font-medium text-label block mb-1.5">Tanggal & Waktu</label>
                        <input type="datetime-local" name="consultation_date" class="growmate-input" required>
                    </div>
                    <button type="submit" class="growmate-btn-primary h-[46px]">Booking</button>
                </form>
            </div>
        @endif

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
                                <h3 class="text-[15px] font-semibold">{{ $cons->topic }}</h3>
                                <p class="text-[11px] text-soft-text">
                                    @if(auth()->user()->role === 'counselor')
                                        Siswa: {{ $cons->student->name }}
                                    @else
                                        Konselor: {{ $cons->counselor->name }}
                                    @endif
                                </p>
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
                        <div class="flex items-center gap-2 text-[10px] text-soft-text">
                            <span>📅 {{ \Carbon\Carbon::parse($cons->consultation_date)->format('d M Y H:i') }}</span>
                        </div>
                        @if($cons->notes)
                            <p class="text-[11px] text-black/70 mt-2 bg-gray-50 rounded-lg p-3">{{ $cons->notes }}</p>
                        @endif

                        @if(auth()->user()->role === 'counselor' && $cons->status === 'pending')
                            <div class="flex gap-2 mt-3">
                                <form method="POST" action="{{ route('consultation.update', $cons) }}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="px-4 py-2 bg-green-100 text-green-600 text-[10px] font-semibold rounded-lg hover:bg-green-200 transition-colors">Setuju</button>
                                </form>
                                <form method="POST" action="{{ route('consultation.update', $cons) }}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="px-4 py-2 bg-red-100 text-red-500 text-[10px] font-semibold rounded-lg hover:bg-red-200 transition-colors">Tolak</button>
                                </form>
                            </div>
                        @endif

                        @if(auth()->user()->role === 'counselor' && $cons->status === 'approved')
                            <div x-data="{ showNote: false }" class="mt-3">
                                <button @click="showNote = !showNote" class="text-[10px] text-primary font-semibold hover:underline">+ Tambah Catatan</button>
                                <form method="POST" action="{{ route('consultation.update', $cons) }}" x-show="showNote" x-transition.duration.200ms class="mt-2 space-y-2">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <textarea name="notes" placeholder="Catatan konsultasi..." class="growmate-input min-h-[60px] resize-none text-[11px]" required></textarea>
                                    <button type="submit" class="growmate-btn-primary h-[36px] text-[10px]">Selesaikan & Simpan</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">💬</div>
                <p class="empty-state-title">Belum ada sesi konsultasi</p>
                @if(auth()->user()->role !== 'counselor')
                    <p class="empty-state-desc">Booking sesi pertamamu sekarang!</p>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>
