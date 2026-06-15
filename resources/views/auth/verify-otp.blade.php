{{-- GrowMate: Verifikasi OTP (otp.png) --}}
<x-guest-layout>
    <div class="growmate-container min-h-screen flex flex-col pb-10">
        <div class="pt-8 mb-6">
            <div class="flex items-center justify-center gap-2">
                <span class="w-8 h-8 bg-primary text-white text-xs rounded-full flex items-center justify-center font-semibold">1</span>
                <span class="w-12 h-1 bg-primary rounded-full"></span>
                <span class="w-8 h-8 bg-primary text-white text-xs rounded-full flex items-center justify-center font-semibold">2</span>
                <span class="w-12 h-1 bg-primary rounded-full"></span>
                <span class="w-8 h-8 bg-gray-200 text-gray-500 text-xs rounded-full flex items-center justify-center font-semibold">3</span>
            </div>
        </div>
        <div class="text-center mb-8">
            <div class="text-5xl mb-4">📧</div>
            <h1 class="text-2xl font-bold text-black">Verifikasi Email</h1>
            <p class="text-[13px] text-soft-text mt-2 max-w-[280px] mx-auto">
                Masukkan kode OTP yang telah dikirim ke email kamu
            </p>
            <p class="text-[11px] font-medium text-primary mt-1">{{ auth()->user()->email ?? 'email@mahasiswa.com' }}</p>
        </div>
        <form method="POST" action="{{ route('otp.verify') }}" x-data="{ digits: ['','','','','',''] }" @submit.prevent="
            document.getElementById('otp_hidden').value = digits.join('');
            $el.submit();
        " class="space-y-6">
            @csrf
            <input type="hidden" name="otp" id="otp_hidden" />
            {{-- 6-digit OTP input --}}
            <div class="flex gap-3 justify-center">
                <template x-for="(_, index) in 6" :key="index">
                    <input type="text" maxlength="1"
                        x-model="digits[index]"
                        @keydown="if ($event.key === 'Backspace') {
                            digits[index] = '';
                            if (index > 0) $nextTick(() => $refs['otp_' + (index - 1)].focus());
                        }"
                        @keyup="if ($event.target.value && index < 5) $nextTick(() => $refs['otp_' + (index + 1)].focus())"
                        :ref="'otp_' + index"
                        class="w-12 h-14 text-center text-lg font-bold border-2 border-border rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 outline-none"
                        inputmode="numeric"
                        required />
                </template>
            </div>
            @error('otp') <p class="text-[10px] text-red-500 mt-1 text-center">{{ $message }}</p> @enderror
            {{-- Kirim Ulang --}}
            <div class="text-center">
                <p class="text-[11px] text-soft-text">Tidak menerima kode? <button type="button" class="text-primary font-semibold underline">Kirim ulang</button></p>
            </div>
            {{-- Submit --}}
            <button type="submit" class="growmate-btn-primary h-[50px]">
                Verifikasi
            </button>
        </form>
    </div>
</x-guest-layout>
