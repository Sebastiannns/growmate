{{-- GrowMate: Admin Dashboard — ringkasan platform --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <p class="text-sm text-soft-text">Panel Admin</p>
                <h1>Dashboard 🛡️</h1>
            </div>
        </div>

        {{-- Stat Cards: 4-col on desktop --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <span class="text-lg">👥</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-primary">{{ $totalUsers }}</p>
                        <p class="text-[10px] lg:text-[11px] text-soft-text font-medium">Total User</p>
                    </div>
                </div>
                <div class="flex gap-2 mt-2">
                    <span class="text-[10px] text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">{{ $totalStudents }} Mhs</span>
                    <span class="text-[10px] text-accent-dark bg-accent/10 px-2 py-0.5 rounded-full">{{ $totalCounselors }} Kons</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0">
                        <span class="text-lg">📅</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-yellow-600">{{ $pendingConsultations }}</p>
                        <p class="text-[10px] lg:text-[11px] text-soft-text font-medium">Konsultasi Pending</p>
                    </div>
                </div>
                <p class="text-[10px] text-yellow-700 mt-2">dari {{ $totalConsultations }} total</p>
            </div>

            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                        <span class="text-lg">💬</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-green-600">{{ $totalPosts }}</p>
                        <p class="text-[10px] lg:text-[11px] text-soft-text font-medium">Postingan Forum</p>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center flex-shrink-0">
                        <span class="text-lg">📚</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-accent-dark">{{ $totalMaterials }}</p>
                        <p class="text-[10px] lg:text-[11px] text-soft-text font-medium">Materi Belajar</p>
                    </div>
                </div>
                <p class="text-[10px] text-accent-dark mt-2">{{ $totalMoods }} Mood tercatat</p>
            </div>
        </div>

        {{-- Desktop: 2-col grid --}}
        <div class="lg:grid lg:grid-cols-2 lg:gap-6 mb-6">
            {{-- Komposisi User --}}
            <div class="stat-card mb-6 lg:mb-0">
                <h3 class="growmate-heading mb-4">Komposisi User</h3>
                @php
                    $studentPct = $totalUsers > 0 ? round(($totalStudents / $totalUsers) * 100) : 0;
                    $counselorPct = $totalUsers > 0 ? round(($totalCounselors / $totalUsers) * 100) : 0;
                    $adminPct = $totalUsers > 0 ? round(($totalAdmins / $totalUsers) * 100) : 0;
                @endphp
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-[11px] lg:text-xs mb-1.5">
                            <span class="font-medium">Mahasiswa</span>
                            <span class="text-soft-text">{{ $studentPct }}%</span>
                        </div>
                        <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-blue-400 rounded-full transition-all duration-500" style="width: {{ $studentPct }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-[11px] lg:text-xs mb-1.5">
                            <span class="font-medium">Konselor</span>
                            <span class="text-soft-text">{{ $counselorPct }}%</span>
                        </div>
                        <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-accent to-accent/80 rounded-full transition-all duration-500" style="width: {{ $counselorPct }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-[11px] lg:text-xs mb-1.5">
                            <span class="font-medium">Admin</span>
                            <span class="text-soft-text">{{ $adminPct }}%</span>
                        </div>
                        <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-green-400 rounded-full transition-all duration-500" style="width: {{ $adminPct }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- User Terbaru --}}
            <div class="stat-card">
                <div class="section-header">
                    <h3 class="growmate-heading">User Terbaru</h3>
                    <a href="{{ route('admin.users') }}" class="text-[10px] lg:text-xs text-primary font-semibold hover:underline">Kelola</a>
                </div>
                <div class="space-y-2">
                    @foreach($recentUsers as $u)
                        <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-50 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[13px] font-medium truncate">{{ $u->name }}</p>
                                <p class="text-[10px] text-soft-text truncate">{{ $u->email }}</p>
                            </div>
                            <span class="growmate-badge flex-shrink-0
                                @if($u->role === 'admin') bg-red-100 text-red-500
                                @elseif($u->role === 'counselor') bg-accent/10 text-accent-dark
                                @else bg-primary/10 text-primary
                                @endif">
                                {{ ucfirst($u->role) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Postingan Terbaru --}}
        <div>
            <div class="section-header">
                <h3 class="growmate-heading">Postingan Terbaru</h3>
                <a href="{{ route('admin.community') }}" class="text-[10px] lg:text-xs text-primary font-semibold hover:underline">Moderasi</a>
            </div>
            <div class="space-y-2">
                @forelse($recentPosts as $post)
                    <div class="stat-card flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">📝</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[13px] font-medium truncate">{{ $post->title }}</p>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-[10px] text-soft-text">oleh {{ $post->user->name }}</span>
                                <span class="text-[9px] text-soft-text">· {{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="stat-card text-center py-6">
                        <p class="text-[13px] text-soft-text">Belum ada postingan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
