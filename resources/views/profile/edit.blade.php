{{-- GrowMate: Edit Profil (edit profil.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('profile.show') }}" class="text-soft-text hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-xl font-bold text-black">Edit Profil</h1>
        </div>

        {{-- Update Profile Info --}}
        <div class="bg-white rounded-2xl p-card shadow-card mb-4">
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Academic Data (khusus student) --}}
        @if(auth()->user()->role === 'student')
            <div class="bg-white rounded-2xl p-card shadow-card mb-4">
                @include('profile.partials.update-academic-form')
            </div>
        @endif

        {{-- Update Password --}}
        <div class="bg-white rounded-2xl p-card shadow-card mb-4">
            @include('profile.partials.update-password-form')
        </div>

        {{-- Delete Account --}}
        <div class="bg-white rounded-2xl p-card shadow-card">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
