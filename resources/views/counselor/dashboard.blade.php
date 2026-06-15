{{-- GrowMate: Counselor Dashboard --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <p class="text-sm text-soft-text">Halo, Konselor</p>
                <h1>{{ auth()->user()->name }} 🌱</h1>
            </div>
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-accent to-primary flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-accent/25">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>

        {{-- Desktop: 2-column grid --}}
        <div class="lg:grid lg:grid-cols-2 lg:gap-6">
            {{-- Left Column: Stats + Schedule --}}
            <div>
                {{-- Stat Cards with Icons --}}
                <div class="grid grid-cols-3 gap-3 mb-6">
                    <div class="stat-card text-center">
                        <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mx-auto mb-2">
                            <span class="text-lg">⏳</span>
                        </div>
                        <p class="text-2xl font-bold text-yellow-600">{{ $pendingCount }}</p>
                        <p class="text-[10px] lg:text-[11px] text-yellow-700 font-medium">Menunggu</p>
                    </div>
                    <div class="stat-card text-center">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-2">
                            <span class="text-lg">📋</span>
                        </div>
                        <p class="text-2xl font-bold text-primary">{{ $activeCount }}</p>
                        <p class="text-[10px] lg:text-[11px] text-primary font-medium">Aktif</p>
                    </div>
                    <div class="stat-card text-center">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-2">
                            <span class="text-lg">✅</span>
                        </div>
                        <p class="text-2xl font-bold text-green-600">{{ $completedCount }}</p>
                        <p class="text-[10px] lg:text-[11px] text-green-600 font-medium">Selesai</p>
                    </div>
                </div>

                {{-- Jadwal Hari Ini --}}
                <div class="mb-6">
                    <div class="section-header">
                        <h3 class="growmate-heading">Jadwal Hari Ini</h3>
                        <a href="{{ route('counselor.schedule') }}" class="text-[10px] lg:text-xs text-primary font-semibold hover:underline">Lihat Semua</a>
                    </div>
                    @if($todayConsultations->count() > 0)
                        <div class="space-y-2">
                            @foreach($todayConsultations as $cons)
                                <div class="stat-card border-l-4
                                    @if($cons->status === 'approved') border-green-400
                                    @elseif($cons->status === 'completed') border-primary
                                    @elseif($cons->status === 'cancelled') border-red-400
                                    @else border-yellow-400
                                    @endif">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-[13px] font-medium">{{ $cons->student->name }}</p>
                                            <p class="text-[10px] lg:text-[11px] text-soft-text truncate">{{ $cons->topic }}</p>
                                            <p class="text-[10px] text-soft-text mt-1">📅 {{ \Carbon\Carbon::parse($cons->consultation_date)->format('H:i') }}</p>
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
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="stat-card text-center py-6">
                            <p class="text-[13px] text-soft-text">Tidak ada jadwal hari ini</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right Column: Articles + History --}}
            <div>
                {{-- Artikel Terbaru --}}
                <div class="mb-6">
                    <div class="section-header">
                        <h3 class="growmate-heading">Artikel Terbaru</h3>
                        <a href="{{ route('counselor.articles') }}" class="text-[10px] lg:text-xs text-primary font-semibold hover:underline">Kelola</a>
                    </div>
                    @if($articles->count() > 0)
                        <div class="space-y-2">
                            @foreach($articles as $article)
                                <div class="stat-card flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-accent/10 flex items-center justify-center text-accent-dark flex-shrink-0">📝</div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-[13px] font-medium truncate">{{ $article->title }}</p>
                                        <p class="text-[10px] text-soft-text">{{ $article->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="stat-card text-center py-6">
                            <p class="text-[13px] text-soft-text">Belum ada artikel</p>
                            <a href="{{ route('counselor.articles') }}" class="text-[10px] lg:text-xs text-primary font-semibold mt-1 inline-block hover:underline">+ Buat artikel</a>
                        </div>
                    @endif
                </div>

                {{-- Riwayat Konsultasi --}}
                <div>
                    <div class="section-header">
                        <h3 class="growmate-heading">Riwayat Konsultasi</h3>
                    </div>
                    <div class="space-y-2">
                        @forelse($recentConsultations as $cons)
                            <div class="stat-card flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">💬</div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[13px] font-medium">{{ $cons->student->name }}</p>
                                    <p class="text-[10px] text-soft-text truncate">{{ $cons->topic }}</p>
                                </div>
                                <span class="text-[10px] text-soft-text flex-shrink-0">{{ $cons->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <div class="stat-card text-center py-6">
                                <p class="text-[13px] text-soft-text">Belum ada riwayat</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
