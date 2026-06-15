<x-guest-layout>
    <div class="min-h-screen max-w-mobile lg:max-w-md mx-auto flex items-center justify-center px-4 py-8">
        <div class="w-full bg-white rounded-2xl shadow-xl p-6 sm:p-8">
            <div class="text-center mb-6">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary to-primary-dark shadow-lg shadow-primary/20 flex items-center justify-center mx-auto mb-4">
                    <img src="{{ asset('images/growmate-logo.png') }}" alt="GrowMate" class="w-full h-full object-contain p-1">
                </div>
                <h1 class="text-lg font-bold text-black">Konfirmasi Password</h1>
                <p class="text-[12px] text-soft-text mt-1">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button>
                        {{ __('Konfirmasi') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
