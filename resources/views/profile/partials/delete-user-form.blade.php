<section class="space-y-4">
    <header class="mb-4">
        <h3 class="growmate-heading text-red-500">Hapus Akun</h3>
        <p class="text-[13px] text-soft-text mt-1">Setelah akun dihapus, semua data akan hilang permanen</p>
    </header>

    <div x-data="{ confirm: false }">
        <button type="button" @click="confirm = true"
                class="w-full h-[46px] border-2 border-red-400 text-red-500 font-semibold text-xs rounded-lg hover:bg-red-50 transition-all duration-200">
            Hapus Akun
        </button>

        <div x-show="confirm" x-collapse class="mt-4 p-4 bg-red-50 rounded-xl border border-red-200">
            <p class="text-[11px] text-red-600 mb-3">Masukkan password untuk konfirmasi</p>
            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-3">
                @csrf
                @method('delete')
                <input type="password" name="password" placeholder="Password" class="growmate-input" required>
                <x-input-error :messages="$errors->userDeletion->get('password')" />
                <div class="flex gap-2">
                    <button type="button" @click="confirm = false"
                            class="flex-1 h-[46px] border-2 border-gray-200 text-soft-text font-semibold text-xs rounded-lg hover:bg-gray-50 transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 h-[46px] bg-red-500 text-white font-semibold text-xs rounded-lg hover:bg-red-600 transition-all duration-200">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
