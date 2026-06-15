{{-- Partial: Update Academic Form — data akademik mahasiswa --}}
<section>
    <header class="mb-4">
        <h3 class="growmate-heading">Data Akademik</h3>
        <p class="text-[13px] text-soft-text mt-1">Update informasi akademik kamu</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="nim" text="NIM" />
            <x-text-input id="nim" name="nim" type="text" placeholder="NIM" value="{{ old('nim', $user->nim) }}" />
            <x-input-error :messages="$errors->get('nim')" />
        </div>

        <div>
            <x-input-label for="jurusan" text="Jurusan" />
            <x-text-input id="jurusan" name="jurusan" type="text" placeholder="Jurusan" value="{{ old('jurusan', $user->jurusan) }}" />
            <x-input-error :messages="$errors->get('jurusan')" />
        </div>

        <div>
            <x-input-label for="fakultas" text="Fakultas" />
            <x-text-input id="fakultas" name="fakultas" type="text" placeholder="Fakultas" value="{{ old('fakultas', $user->fakultas) }}" />
            <x-input-error :messages="$errors->get('fakultas')" />
        </div>

        <div>
            <x-input-label for="semester" text="Semester" />
            <select id="semester" name="semester" class="growmate-input">
                <option value="">Pilih semester</option>
                @for ($i = 1; $i <= 14; $i++)
                    <option value="{{ $i }}" {{ old('semester', $user->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                @endfor
            </select>
            <x-input-error :messages="$errors->get('semester')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="growmate-btn-primary h-[46px] max-w-[120px]">Simpan</button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" class="text-[11px] text-green-600">Tersimpan!</p>
            @endif
        </div>
    </form>
</section>
