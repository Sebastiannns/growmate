<section>
    <header class="mb-4">
        <h3 class="growmate-heading">Ganti Password</h3>
        <p class="text-[13px] text-soft-text mt-1">Pastikan password kamu aman</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" text="Password Saat Ini" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" placeholder="Masukkan password saat ini" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
            <x-input-label for="update_password_password" text="Password Baru" />
            <x-text-input id="update_password_password" name="password" type="password" placeholder="Masukkan password baru" />
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" text="Konfirmasi Password Baru" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" placeholder="Ulangi password baru" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="growmate-btn-primary h-[46px] max-w-[120px]">Simpan</button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" class="text-[11px] text-green-600">Tersimpan!</p>
            @endif
        </div>
    </form>
</section>
