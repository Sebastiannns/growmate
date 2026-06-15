{{-- GrowMate: Halaman Awal — responsive split layout (desktop: brand + CTA) --}}
<x-guest-layout>
    <div class="min-h-screen lg:flex" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 100)">
        {{-- BRAND PANEL — desktop only --}}
        <div class="hidden lg:flex lg:w-1/2 lg:min-h-screen lg:bg-gradient-to-br lg:from-primary lg:via-primary-dark lg:to-accent lg:items-center lg:justify-center lg:p-12 lg:relative lg:overflow-hidden"
             x-cloak
             x-show="loaded"
             x-transition:enter.duration.800ms>
            {{-- Decorative blobs --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
                <div class="absolute -top-20 -right-20 w-[400px] h-[400px] rounded-full bg-white/[0.08] blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-[400px] h-[400px] rounded-full bg-white/[0.05] blur-3xl"></div>
            </div>
            <div class="relative text-center text-white max-w-sm">
                {{-- Logo --}}
                <div class="w-20 h-20 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center mx-auto mb-6 ring-2 ring-white/20">
                    <img src="{{ asset('images/growmate-logo.png') }}" alt="GrowMate" class="w-full h-full object-contain p-2">
                </div>
                <h2 class="text-3xl font-bold">GrowMate</h2>
                <p class="text-white/80 mt-3 leading-relaxed text-sm">Teman tumbuh kembangmu di universitas.</p>

                {{-- Ilustrasi besar --}}
                <div class="mt-14">
                    <div class="w-52 h-52 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto ring-2 ring-white/10 shadow-2xl shadow-white/5">
                        <div class="text-center">
                            <div class="text-7xl mb-1">🌱</div>
                            <p class="text-white font-semibold text-base">Mulai Perjalananmu</p>
                            <p class="text-white/60 text-[11px] mt-1">Tumbuh bersama GrowMate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA PANEL --}}
        <div class="flex-1 min-h-screen flex items-center justify-center bg-white px-6 py-8"
             x-cloak
             x-show="loaded"
             x-transition:enter.duration.800ms x-transition:enter.delay.200ms>
            <div class="w-full max-w-[400px]">
                {{-- Mobile logo (visible only on mobile) --}}
                <div class="lg:hidden flex justify-center mb-6">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary to-primary-dark shadow-lg shadow-primary/20 flex items-center justify-center">
                        <img src="{{ asset('images/growmate-logo.png') }}" alt="GrowMate" class="w-full h-full object-contain p-1.5">
                    </div>
                </div>

                {{-- Mobile header + ilustrasi (visible only on mobile) --}}
                <div class="lg:hidden text-center mb-8">
                    <h1 class="text-2xl font-bold text-black">GrowMate</h1>
                    <p class="text-[13px] text-soft-text mt-2 max-w-[280px] mx-auto leading-relaxed">
                        Teman tumbuh kembangmu di universitas. Kelola kesehatan mental dan akademikmu dengan lebih baik!
                    </p>
                </div>
                <div class="lg:hidden flex justify-center mb-10">
                    <div class="w-48 h-48 bg-gradient-to-br from-primary/10 to-accent/10 rounded-full flex items-center justify-center ring-2 ring-primary/5">
                        <div class="text-center">
                            <div class="text-6xl mb-1">🌱</div>
                            <p class="text-primary font-semibold text-sm">Mulai Perjalananmu</p>
                        </div>
                    </div>
                </div>

                {{-- Heading (desktop only) --}}
                <div class="hidden lg:block text-center lg:text-left mb-10">
                    <h1 class="text-2xl font-bold text-black">Selamat Datang di GrowMate</h1>
                    <p class="text-[13px] text-soft-text mt-2 leading-relaxed">
                        Teman tumbuh kembangmu di universitas. Kelola kesehatan mental dan akademikmu dengan lebih baik!
                    </p>
                </div>

                {{-- CTA Buttons --}}
                <div class="space-y-3">
                    <a href="{{ route('login') }}"
                       class="growmate-btn-primary text-sm h-[50px] gap-2 group">
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="w-full h-[50px] border-2 border-primary text-primary font-semibold text-sm rounded-xl flex items-center justify-center gap-2 hover:bg-primary/5 hover:shadow-sm active:scale-[0.98] transition-all duration-200 group">
                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Daftar
                    </a>
                    <div class="text-center pt-2">
                        <a href="{{ route('options') }}" class="text-[11px] text-soft-text underline hover:text-primary transition-colors">Lihat semua opsi</a>
                    </div>
                </div>

                {{-- Footer --}}
                <p class="text-center text-[10px] text-soft-text mt-8 leading-relaxed">
                    Dengan mendaftar, kamu menyetujui
                    <a href="#" class="underline hover:text-primary transition-colors">Syarat & Ketentuan</a>
                    dan
                    <a href="#" class="underline hover:text-primary transition-colors">Kebijakan Privasi</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
