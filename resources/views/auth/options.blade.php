{{-- GrowMate: Pilihan Role (opsi.png) --}}
<x-guest-layout>
    <div class="growmate-container min-h-screen flex flex-col justify-center pb-10">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-black">Kamu siapa?</h1>
            <p class="text-[13px] text-soft-text mt-2">Pilih peranmu untuk memulai GrowMate</p>
        </div>
        <div class="space-y-4">
            {{-- Opsi Mahasiswa --}}
            <a href="{{ route('register') }}?role=student" class="block bg-white rounded-2xl shadow-card p-6 hover:ring-2 hover:ring-primary transition-all duration-200">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-2xl">
                        🎓
                    </div>
                    <div class="flex-1">
                        <h3 class="growmate-heading">Mahasiswa</h3>
                        <p class="growmate-body text-soft-text">Kelola tugas, pantau mood, dan konsultasi</p>
                    </div>
                    <svg class="w-5 h-5 text-soft-text" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>
            {{-- Opsi Konselor --}}
            <a href="{{ route('register') }}?role=counselor" class="block bg-white rounded-2xl shadow-card p-6 hover:ring-2 hover:ring-accent transition-all duration-200">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-accent/10 rounded-2xl flex items-center justify-center text-2xl">
                        💼
                    </div>
                    <div class="flex-1">
                        <h3 class="growmate-heading">Konselor</h3>
                        <p class="growmate-body text-soft-text">Bimbing mahasiswa dan kelola jadwal</p>
                    </div>
                    <svg class="w-5 h-5 text-soft-text" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>
            {{-- Opsi Admin (tersembunyi, akses langsung) --}}
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('login') }}" class="text-[11px] text-soft-text underline">Sudah punya akun? Masuk</a>
        </div>
    </div>
</x-guest-layout>
