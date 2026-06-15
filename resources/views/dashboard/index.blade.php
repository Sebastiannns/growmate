{{-- GrowMate: Dashboard / Beranda (beranda.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <p class="text-sm text-soft-text">Halo,</p>
                <h1>{{ $user->name }} 🌱</h1>
            </div>
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-primary/25">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
        </div>

        {{-- Desktop: 2-column grid --}}
        <div class="lg:grid lg:grid-cols-2 lg:gap-6">
            {{-- Left Column: Mood + Tasks --}}
            <div>
                {{-- Mood Quick Select --}}
                <div class="mb-6">
                    <div class="section-header">
                        <h3 class="growmate-heading">Apa yang kamu rasakan?</h3>
                    </div>
                    <div class="grid grid-cols-5 gap-2">
                        <a href="{{ route('mood.index') }}" class="growmate-mood-card">
                            <span class="text-3xl">😊</span>
                            <span class="text-[11px] font-medium">Senang</span>
                        </a>
                        <a href="{{ route('mood.index') }}" class="growmate-mood-card">
                            <span class="text-3xl">😐</span>
                            <span class="text-[11px] font-medium">Biasa</span>
                        </a>
                        <a href="{{ route('mood.index') }}" class="growmate-mood-card">
                            <span class="text-3xl">😢</span>
                            <span class="text-[11px] font-medium">Sedih</span>
                        </a>
                        <a href="{{ route('mood.index') }}" class="growmate-mood-card">
                            <span class="text-3xl">😤</span>
                            <span class="text-[11px] font-medium">Stres</span>
                        </a>
                        <a href="{{ route('mood.index') }}" class="growmate-mood-card">
                            <span class="text-3xl">😴</span>
                            <span class="text-[11px] font-medium">Lelah</span>
                        </a>
                    </div>
                </div>

                {{-- Tugas Hari Ini --}}
                <div class="mb-6">
                    <div class="section-header">
                        <h3 class="growmate-heading">Tugas Hari Ini</h3>
                        <a href="{{ route('task.index') }}" class="text-[10px] lg:text-xs text-primary font-semibold hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-2">
                        @forelse($tasks as $task)
                            <a href="{{ route('task.index') }}" class="flex items-center gap-3 bg-white rounded-xl p-4 shadow-sm border border-border/50 hover:bg-gray-50 transition-colors">
                                <div class="w-4 h-4 rounded-full border-2 flex-shrink-0 {{ $task->status === 'in_progress' ? 'bg-yellow-400 border-yellow-400' : 'border-primary' }}"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[13px] font-medium truncate">{{ $task->title }}</p>
                                    @if($task->deadline)
                                        <p class="text-[10px] text-soft-text">Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</p>
                                    @endif
                                </div>
                                @if($task->status === 'in_progress')
                                    <span class="growmate-badge bg-yellow-100 text-yellow-600 flex-shrink-0">Progres</span>
                                @else
                                    <span class="growmate-badge bg-primary/10 text-primary flex-shrink-0">Baru</span>
                                @endif
                            </a>
                        @empty
                            <div class="stat-card text-center py-6">
                                <p class="text-[13px] text-soft-text">Tidak ada tugas hari ini</p>
                                <a href="{{ route('task.index') }}" class="text-[10px] lg:text-xs text-primary font-semibold mt-1 inline-block hover:underline">+ Tambah tugas</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Right Column: Quote + Timer + Progress + Consultation --}}
            <div>
                {{-- Quote Motivasi --}}
                <div class="bg-gradient-to-br from-primary/[0.12] to-accent/[0.12] rounded-2xl p-5 lg:p-6 mb-6 border border-primary/[0.05]">
                    <div class="flex items-start gap-3">
                        <span class="text-2xl flex-shrink-0">💡</span>
                        <div>
                            <p class="text-[13px] lg:text-[14px] italic text-black/70 leading-relaxed">
                                "Setiap langkah kecil yang kamu ambil hari ini akan membawamu lebih dekat ke tujuan besarmu. Tetap semangat!"
                            </p>
                            <p class="text-[10px] lg:text-[11px] text-primary font-semibold mt-2">— GrowMate</p>
                        </div>
                    </div>
                </div>

                {{-- Focus Timer Mini --}}
                <div class="stat-card mb-6">
                    <div class="section-header">
                        <h3 class="growmate-heading">Focus Timer</h3>
                        <a href="{{ route('timer.index') }}" class="text-[10px] lg:text-xs text-primary font-semibold hover:underline">Mulai →</a>
                    </div>
                    <div class="text-center py-2">
                        <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent mb-1">25:00</div>
                        <p class="text-[10px] lg:text-[11px] text-soft-text">Fokus belajar 25 menit</p>
                    </div>
                </div>

                {{-- Progress Tugas --}}
                <div class="stat-card mb-6">
                    <h3 class="growmate-heading mb-4">Progress Tugas</h3>
                    @php $pct = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0; @endphp
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white font-bold text-lg shadow-md flex-shrink-0">
                            {{ $pct }}%
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[13px] font-medium">{{ $completedTasks }} dari {{ $totalTasks }} tugas selesai</p>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden mt-1.5">
                                <div class="h-full bg-gradient-to-r from-primary to-primary-dark rounded-full transition-all duration-500" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Konsultasi Reminder --}}
                <div class="stat-card border-l-4 border-primary mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-lg flex-shrink-0">💬</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[13px] font-semibold">Konsultasi Terjadwal</p>
                            <p class="text-[10px] lg:text-[11px] text-soft-text">Sesi dengan Dr. Sarah — Besok 14:00</p>
                        </div>
                        <a href="#" class="text-[10px] lg:text-xs text-primary font-semibold hover:underline flex-shrink-0">Detail →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
