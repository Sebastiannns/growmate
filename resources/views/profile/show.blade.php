{{-- GrowMate: Profile (profil.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="text-center mb-8">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center mx-auto mb-4 overflow-hidden shadow-lg shadow-primary/20">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="avatar" class="w-full h-full object-cover">
                @else
                    <span class="text-white text-3xl font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                @endif
            </div>
            <h1 class="text-xl font-bold text-black">{{ auth()->user()->name }}</h1>
            <p class="text-[13px] text-soft-text capitalize">{{ auth()->user()->role === 'student' ? 'Mahasiswa' : (auth()->user()->role === 'counselor' ? 'Konselor' : 'Admin') }}</p>
            @if(auth()->user()->role === 'student')
                <p class="text-[10px] text-soft-text">{{ auth()->user()->nim }} · {{ auth()->user()->jurusan }}</p>
            @endif
        </div>

        <div class="grid grid-cols-3 gap-3 mb-6">
            <div class="stat-card text-center">
                <span class="text-2xl">😊</span>
                <p class="text-[18px] font-bold text-black mt-1">{{ $moodCount }}</p>
                <p class="text-[10px] text-soft-text">Mood Tercatat</p>
            </div>
            <div class="stat-card text-center">
                <span class="text-2xl">✅</span>
                <p class="text-[18px] font-bold text-black mt-1">{{ $taskCount }}</p>
                <p class="text-[10px] text-soft-text">Tugas Selesai</p>
            </div>
            <div class="stat-card text-center">
                <span class="text-2xl">🍅</span>
                <p class="text-[18px] font-bold text-black mt-1">{{ $focusCount }}</p>
                <p class="text-[10px] text-soft-text">Sesi Fokus</p>
            </div>
        </div>

        <div class="space-y-1">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 bg-white rounded-xl p-4 shadow-sm border border-border/50 hover:bg-gray-50 transition-colors">
                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-medium">Edit Profil</p>
                    <p class="text-[10px] text-soft-text">Ubah data diri dan foto profil</p>
                </div>
                <svg class="w-4 h-4 text-soft-text" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('mood.index') }}" class="flex items-center gap-3 bg-white rounded-xl p-4 shadow-sm border border-border/50 hover:bg-gray-50 transition-colors">
                <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center">
                    <span class="text-lg">😊</span>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-medium">Riwayat Mood</p>
                    <p class="text-[10px] text-soft-text">Lihat catatan mood kamu</p>
                </div>
                <svg class="w-4 h-4 text-soft-text" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('task.index') }}" class="flex items-center gap-3 bg-white rounded-xl p-4 shadow-sm border border-border/50 hover:bg-gray-50 transition-colors">
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                    <span class="text-lg">📋</span>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-medium">Daftar Tugas</p>
                    <p class="text-[10px] text-soft-text">Kelola tugas akademik</p>
                </div>
                <svg class="w-4 h-4 text-soft-text" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('analytics.index') }}" class="flex items-center gap-3 bg-white rounded-xl p-4 shadow-sm border border-border/50 hover:bg-gray-50 transition-colors">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                    <span class="text-lg">📊</span>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-medium">Analitik</p>
                    <p class="text-[10px] text-soft-text">Lihat statistik dan perkembangan</p>
                </div>
                <svg class="w-4 h-4 text-soft-text" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 bg-white rounded-xl p-4 shadow-sm border border-border/50 hover:bg-red-50 transition-colors text-left">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-[13px] font-medium text-red-500">Keluar</p>
                        <p class="text-[10px] text-soft-text">Logout dari aplikasi</p>
                    </div>
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
