{{-- GrowMate: Data Pribadi (data pribadi.png) --}}
<x-guest-layout>
    <div class="growmate-container min-h-screen flex flex-col pb-10">
        <div class="pt-8 mb-6">
            <div class="flex items-center justify-center gap-2">
                <span class="w-8 h-8 bg-primary text-white text-xs rounded-full flex items-center justify-center font-semibold">1</span>
                <span class="w-12 h-1 bg-gray-200 rounded-full"></span>
                <span class="w-8 h-8 bg-gray-200 text-gray-500 text-xs rounded-full flex items-center justify-center font-semibold">2</span>
                <span class="w-12 h-1 bg-gray-200 rounded-full"></span>
                <span class="w-8 h-8 bg-gray-200 text-gray-500 text-xs rounded-full flex items-center justify-center font-semibold">3</span>
            </div>
        </div>
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-black">Data Pribadi</h1>
            <p class="text-[13px] text-soft-text mt-2">Lengkapi data akademik kamu</p>
        </div>
        <form method="POST" action="{{ route('personal-data.store') }}" class="space-y-5">
            @csrf
            {{-- NIM --}}
            <div>
                <x-input-label for="nim" text="NIM" />
                <x-text-input id="nim" name="nim" type="text" placeholder="Masukkan NIM" value="{{ old('nim') }}" required />
                @error('nim') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Jurusan --}}
            <div>
                <x-input-label for="jurusan" text="Jurusan" />
                <x-text-input id="jurusan" name="jurusan" type="text" placeholder="Masukkan jurusan" value="{{ old('jurusan') }}" required />
                @error('jurusan') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Fakultas --}}
            <div>
                <x-input-label for="fakultas" text="Fakultas" />
                <x-text-input id="fakultas" name="fakultas" type="text" placeholder="Masukkan fakultas" value="{{ old('fakultas') }}" required />
                @error('fakultas') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Semester --}}
            <div>
                <x-input-label for="semester" text="Semester" />
                <select id="semester" name="semester" class="growmate-input" required>
                    <option value="">Pilih semester</option>
                    @for ($i = 1; $i <= 14; $i++)
                        <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                    @endfor
                </select>
                @error('semester') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- No. Telepon --}}
            <div>
                <x-input-label for="phone" text="No. Telepon" />
                <x-text-input id="phone" name="phone" type="tel" placeholder="Masukkan no. telepon" value="{{ old('phone') }}" required />
                @error('phone') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Submit --}}
            <button type="submit" class="growmate-btn-primary h-[50px]">
                Selanjutnya
            </button>
        </form>
    </div>
</x-guest-layout>
