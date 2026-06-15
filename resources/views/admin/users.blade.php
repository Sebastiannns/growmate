{{-- GrowMate: Admin Users — manajemen user --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.dashboard') }}" class="text-soft-text hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-black">Manajemen User</h1>
                <p class="text-[13px] text-soft-text">Kelola semua pengguna platform</p>
            </div>
        </div>

        {{-- Filter & Search --}}
        <form method="GET" action="{{ route('admin.users') }}" class="mb-6 space-y-3">
            <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
                <a href="{{ route('admin.users') }}"
                   class="px-4 py-2 rounded-xl text-[11px] font-medium whitespace-nowrap transition-all duration-200
                          {{ $currentRole === 'all' ? 'bg-primary text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200' }}">
                    Semua
                </a>
                <a href="{{ route('admin.users', ['role' => 'student']) }}"
                   class="px-4 py-2 rounded-xl text-[11px] font-medium whitespace-nowrap transition-all duration-200
                          {{ $currentRole === 'student' ? 'bg-primary text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200' }}">
                    Mahasiswa
                </a>
                <a href="{{ route('admin.users', ['role' => 'counselor']) }}"
                   class="px-4 py-2 rounded-xl text-[11px] font-medium whitespace-nowrap transition-all duration-200
                          {{ $currentRole === 'counselor' ? 'bg-accent text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200' }}">
                    Konselor
                </a>
                <a href="{{ route('admin.users', ['role' => 'admin']) }}"
                   class="px-4 py-2 rounded-xl text-[11px] font-medium whitespace-nowrap transition-all duration-200
                          {{ $currentRole === 'admin' ? 'bg-red-400 text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200' }}">
                    Admin
                </a>
            </div>
            <div class="flex gap-2">
                <input type="text" name="search" placeholder="Cari nama atau email..." class="growmate-input flex-1" value="{{ request('search') }}">
                <button type="submit" class="px-4 py-2 bg-primary text-white text-xs font-semibold rounded-lg hover:bg-primary-dark transition-colors">Cari</button>
            </div>
        </form>

        {{-- Daftar User --}}
        @if($users->count() > 0)
            <div class="space-y-2">
                @foreach($users as $user)
                    <div class="bg-white rounded-2xl p-4 shadow-card">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm flex-shrink-0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[13px] font-medium">{{ $user->name }}</p>
                                <p class="text-[10px] text-soft-text truncate">{{ $user->email }}</p>
                                @if($user->nim)
                                    <p class="text-[9px] text-soft-text">{{ $user->nim }} · {{ $user->jurusan }} · Sem {{ $user->semester }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            {{-- Edit Role --}}
                            <form method="POST" action="{{ route('admin.users.role', $user) }}" class="flex items-center gap-2">
                                @csrf @method('PATCH')
                                <select name="role" class="text-[10px] border border-border rounded-lg px-2 py-1.5 focus:border-primary focus:ring-1 focus:ring-primary/20">
                                    <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Mahasiswa</option>
                                    <option value="counselor" {{ $user->role === 'counselor' ? 'selected' : '' }}>Konselor</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <button type="submit" class="text-[10px] text-primary font-semibold hover:underline">Simpan</button>
                            </form>

                            {{-- Delete --}}
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-7 h-7 rounded-lg bg-red-50 text-red-400 flex items-center justify-center hover:bg-red-100 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @else
            <div class="text-center py-10">
                <span class="text-4xl">👥</span>
                <p class="text-[13px] text-soft-text mt-3">Tidak ada user ditemukan</p>
            </div>
        @endif
    </div>
</x-app-layout>
