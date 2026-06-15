<section>
    <header class="mb-4">
        <h3 class="growmate-heading">Informasi Profil</h3>
        <p class="text-[13px] text-soft-text mt-1">Update nama dan email kamu</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" text="Nama Lengkap" />
            <x-text-input id="name" name="name" type="text" placeholder="Nama lengkap" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" text="Email" />
            <x-text-input id="email" name="email" type="email" placeholder="Email" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="phone" text="No. Telepon" />
            <x-text-input id="phone" name="phone" type="tel" placeholder="No. telepon" value="{{ old('phone', $user->phone) }}" />
            <x-input-error :messages="$errors->get('phone')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="growmate-btn-primary h-[46px] max-w-[120px]">Simpan</button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" class="text-[11px] text-green-600">Tersimpan!</p>
            @endif
        </div>
    </form>
</section>
