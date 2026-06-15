{{-- GrowMate: Buat Akun (buat akun.png) --}}
<x-guest-layout>
    <div class="growmate-container min-h-screen flex flex-col pb-10">
        <div class="pt-8 mb-6">
            <a href="{{ route('options') }}" class="text-soft-text hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
        </div>
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-black">Buat Akun</h1>
            <p class="text-[13px] text-soft-text mt-2">Daftar untuk mulai menggunakan GrowMate</p>
        </div>
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="role" value="{{ request('role', 'student') }}">
            {{-- Nama Lengkap --}}
            <div>
                <x-input-label for="name" text="Nama Lengkap" />
                <x-text-input id="name" name="name" type="text" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus />
                @error('name') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Email --}}
            <div>
                <x-input-label for="email" text="Email" />
                <x-text-input id="email" name="email" type="email" placeholder="Masukkan email" value="{{ old('email') }}" required />
                @error('email') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Password --}}
            <div>
                <x-input-label for="password" text="Password" />
                <x-text-input id="password" name="password" type="password" placeholder="Masukkan password" required />
                @error('password') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Konfirmasi Password --}}
            <div>
                <x-input-label for="password_confirmation" text="Konfirmasi Password" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" placeholder="Ulangi password" required />
                @error('password_confirmation') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Link ke login --}}
            <div class="text-center">
                <p class="text-[11px] text-soft-text">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary font-semibold underline">Masuk</a></p>
            </div>
            {{-- Submit --}}
            <button type="submit" class="growmate-btn-primary h-[50px]">
                Daftar
            </button>
        </form>
    </div>
</x-guest-layout>
