{{-- GrowMate: Analytics — statistik dan perkembangan --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="page-header">
            <div>
                <p class="text-sm text-soft-text">Analitik</p>
                <h1>Lihat perkembangan dan statistikmu</h1>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
            <div class="stat-card text-center">
                <span class="text-2xl">🔥</span>
                <p class="text-[22px] font-bold text-black mt-1">{{ $streak }}</p>
                <p class="text-[10px] text-soft-text">Streak Mood</p>
            </div>
            <div class="stat-card text-center">
                <span class="text-2xl">📊</span>
                <p class="text-[22px] font-bold text-black mt-1">{{ $taskCompletionRate }}%</p>
                <p class="text-[10px] text-soft-text">Tugas Selesai</p>
            </div>
            <div class="stat-card text-center">
                <span class="text-2xl">✅</span>
                <p class="text-[22px] font-bold text-black mt-1">{{ $completedTasks }}</p>
                <p class="text-[10px] text-soft-text">Tugas Selesai</p>
            </div>
            <div class="stat-card text-center">
                <span class="text-2xl">{{ $topMood ? ['senang' => '😊', 'biasa' => '😐', 'sedih' => '😢', 'stres' => '😤', 'lelah' => '😴', 'termotivasi' => '💪'][$topMood] ?? '😊' : '😊' }}</span>
                <p class="text-[22px] font-bold text-black mt-1 capitalize">{{ $topMood ?? '-' }}</p>
                <p class="text-[10px] text-soft-text">Mood Terbanyak</p>
            </div>
        </div>

        <div class="lg:grid lg:grid-cols-2 lg:gap-6 mb-6">
            <div class="stat-card mb-6 lg:mb-0">
                <h3 class="growmate-heading mb-4">Progress Tugas</h3>
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between text-[11px] lg:text-xs mb-1">
                            <span class="font-medium">Selesai</span>
                            <span class="text-green-600">{{ $completedTasks }}</span>
                        </div>
                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-400 to-green-500 rounded-full transition-all duration-500" style="width: {{ $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-[11px] lg:text-xs mb-1">
                            <span class="font-medium">Diproses</span>
                            <span class="text-yellow-600">{{ $inProgressTasks }}</span>
                        </div>
                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-full transition-all duration-500" style="width: {{ $totalTasks > 0 ? ($inProgressTasks / $totalTasks) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-[11px] lg:text-xs mb-1">
                            <span class="font-medium">Menunggu</span>
                            <span class="text-soft-text">{{ $pendingTasks }}</span>
                        </div>
                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-gray-300 to-gray-400 rounded-full transition-all duration-500" style="width: {{ $totalTasks > 0 ? ($pendingTasks / $totalTasks) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <h3 class="growmate-heading mb-4">Distribusi Mood (30 hari)</h3>
                @if($moodDistribution->count() > 0)
                    <div class="space-y-3">
                        @foreach(['senang' => '😊', 'biasa' => '😐', 'sedih' => '😢', 'stres' => '😤', 'lelah' => '😴', 'termotivasi' => '💪'] as $key => $emoji)
                            @if(isset($moodDistribution[$key]))
                                @php $pct = $moodLogs->count() > 0 ? round(($moodDistribution[$key] / $moodLogs->count()) * 100) : 0; @endphp
                                <div>
                                    <div class="flex justify-between text-[11px] lg:text-xs mb-1">
                                        <span>{{ $emoji }} {{ ucfirst($key) }}</span>
                                        <span class="text-soft-text">{{ $moodDistribution[$key] }}x ({{ $pct }}%)</span>
                                    </div>
                                    <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-primary to-primary-dark rounded-full transition-all duration-500" style="width: {{ $pct }}%"></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <p class="text-[10px] text-soft-text mt-3">Total {{ $moodLogs->count() }} catatan mood</p>
                @else
                    <div class="text-center py-4">
                        <p class="text-[13px] text-soft-text">Belum ada data mood</p>
                    </div>
                @endif
            </div>
        </div>

        @if($moodLogs->count() > 0)
            <div class="stat-card">
                <h3 class="growmate-heading mb-4">Riwayat Mood Terakhir</h3>
                <div class="flex gap-1.5 overflow-x-auto pb-2">
                    @foreach($moodLogs->take(30) as $log)
                        <div class="flex flex-col items-center gap-1 flex-shrink-0">
                            <span class="text-lg">
                                @switch($log->mood)
                                    @case('senang') 😊 @break
                                    @case('biasa') 😐 @break
                                    @case('sedih') 😢 @break
                                    @case('stres') 😤 @break
                                    @case('lelah') 😴 @break
                                    @case('termotivasi') 💪 @break
                                    @default 🙂
                                @endswitch
                            </span>
                            <span class="text-[8px] text-soft-text">{{ $log->date->format('d') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
