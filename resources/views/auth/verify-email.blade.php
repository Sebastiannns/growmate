<x-guest-layout>
    <div class="min-h-screen max-w-mobile lg:max-w-md mx-auto flex items-center justify-center px-4 py-8">
        <div class="w-full bg-white rounded-2xl shadow-xl p-6 sm:p-8">
            <div class="text-center mb-6">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary to-primary-dark shadow-lg shadow-primary/20 flex items-center justify-center mx-auto mb-4">
                    <img src="{{ asset('images/growmate-logo.png') }}" alt="GrowMate" class="w-full h-full object-contain p-1">
                </div>
                <h1 class="text-lg font-bold text-black">Verifikasi Email</h1>
                <p class="text-[12px] text-soft-text mt-1">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}</p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 rounded-xl px-4 py-3">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="flex items-center justify-between gap-3">
                <form method="POST" action="{{ route('verification.send') }}" class="flex-1">
                    @csrf
                    <x-primary-button>
                        {{ __('Kirim Ulang Email') }}
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2.5 text-sm font-medium text-soft-text hover:text-black bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                        {{ __('Keluar') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
