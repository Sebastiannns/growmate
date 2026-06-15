{{-- GrowMate: Masuk — responsive split layout (desktop: brand + form) --}}
<x-guest-layout>
    <div class="min-h-screen lg:flex">
        {{-- BRAND PANEL — desktop only --}}
        <div class="hidden lg:flex lg:w-1/2 lg:min-h-screen lg:bg-gradient-to-br lg:from-primary lg:via-primary-dark lg:to-accent lg:items-center lg:justify-center lg:p-12 lg:relative lg:overflow-hidden">
            {{-- Decorative blobs inside brand panel --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
                <div class="absolute -top-20 -right-20 w-[400px] h-[400px] rounded-full bg-white/[0.08] blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-[400px] h-[400px] rounded-full bg-white/[0.05] blur-3xl"></div>
            </div>
            <div class="relative text-center text-white max-w-sm">
                <div class="w-20 h-20 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center mx-auto mb-6 ring-2 ring-white/20">
                    <img src="{{ asset('images/growmate-logo.png') }}" alt="GrowMate" class="w-full h-full object-contain p-2">
                </div>
                <h2 class="text-3xl font-bold">GrowMate</h2>
                <p class="text-white/80 mt-3 leading-relaxed">Teman tumbuh kembangmu di universitas. Kelola kesehatan mental dan akademikmu dengan lebih baik!</p>
            </div>
        </div>

        {{-- FORM PANEL --}}
        <div class="flex-1 min-h-screen flex items-center justify-center bg-white px-6 py-8">
            <div class="w-full max-w-[400px]">
                {{-- Mobile logo (visible only on mobile) --}}
                <div class="lg:hidden flex justify-center mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary to-primary-dark shadow-lg shadow-primary/20 flex items-center justify-center">
                        <img src="{{ asset('images/growmate-logo.png') }}" alt="GrowMate" class="w-full h-full object-contain p-1">
                    </div>
                </div>

                {{-- Heading --}}
                <div class="text-center lg:text-left mb-8">
                    <h1 class="text-xl font-bold text-black">Selamat Datang</h1>
                    <p class="text-[13px] text-soft-text mt-1">Silakan masuk untuk melanjutkan</p>
                </div>

                {{-- Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="text-[11px] font-medium text-label block mb-1.5">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-soft-text" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <input id="email" name="email" type="email" placeholder="Masukkan email" value="{{ old('email') }}" required autofocus
                                   class="growmate-input pl-11 @error('email') border-red-400 focus:border-red-400 focus:ring-red-200 @enderror">
                        </div>
                        @error('email') <p class="text-[10px] text-red-500 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    {{-- Password with show/hide toggle --}}
                    <div x-data="{ show: false }">
                        <label for="password" class="text-[11px] font-medium text-label block mb-1.5">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-soft-text" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input :type="show ? 'text' : 'password'" id="password" name="password" placeholder="Masukkan password" required
                                   class="growmate-input pl-11 pr-11 @error('password') border-red-400 focus:border-red-400 focus:ring-red-200 @enderror">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-soft-text hover:text-black transition-colors" :aria-label="show ? 'Sembunyikan password' : 'Tampilkan password'" tabindex="-1">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        @error('password') <p class="text-[10px] text-red-500 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    {{-- Remember & Forgot --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="remember" class="rounded border-border text-primary focus:ring-primary/20 cursor-pointer">
                            <span class="text-[11px] text-soft-text">Ingat saya</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-[11px] text-primary font-semibold hover:text-primary-dark transition-colors">Lupa password?</a>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="w-full h-[50px] bg-gradient-to-r from-primary to-primary-dark text-white font-semibold text-sm rounded-xl hover:shadow-lg hover:shadow-primary/20 transition-all duration-200 active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">
                        Masuk
                    </button>

                    {{-- Register Link --}}
                    <div class="text-center pt-1">
                        <p class="text-[11px] text-soft-text">Belum punya akun? <a href="{{ route('register') }}" class="text-primary font-semibold hover:text-primary-dark transition-colors">Daftar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
