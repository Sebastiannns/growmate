{{-- GrowMate: Mood Tracker (mood.png, riwayat mood.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="page-header">
            <div>
                <p class="text-sm text-soft-text">Mood Tracker</p>
                <h1>Bagaimana perasaanmu hari ini?</h1>
            </div>
            <span class="text-sm text-soft-text">{{ now()->format('d M Y') }}</span>
        </div>

        <div class="lg:grid lg:grid-cols-2 lg:gap-6">
            <div x-data="{ selected: '{{ $todayMood->mood ?? '' }}', note: '{{ $todayMood->note ?? '' }}' }">
                <form method="POST" action="{{ route('mood.store') }}" @submit.prevent="
                    if (!selected) { alert('Pilih mood terlebih dahulu'); return; }
                    $el.querySelector('input[name=mood]').value = selected;
                    $el.querySelector('textarea[name=note]').value = note;
                    $el.submit();
                ">
                    @csrf
                    <input type="hidden" name="mood" value="">
                    @error('mood') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                    <textarea name="note" class="hidden"></textarea>
                    @error('note') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror

                    <div class="grid grid-cols-3 lg:grid-cols-6 gap-3 mb-6">
                        <div class="growmate-mood-card cursor-pointer"
                             :class="{ 'selected': selected === 'senang' }"
                             @click="selected = 'senang'">
                            <span class="text-3xl">😊</span>
                            <span class="text-[11px] font-medium">Senang</span>
                        </div>
                        <div class="growmate-mood-card cursor-pointer"
                             :class="{ 'selected': selected === 'biasa' }"
                             @click="selected = 'biasa'">
                            <span class="text-3xl">😐</span>
                            <span class="text-[11px] font-medium">Biasa</span>
                        </div>
                        <div class="growmate-mood-card cursor-pointer"
                             :class="{ 'selected': selected === 'sedih' }"
                             @click="selected = 'sedih'">
                            <span class="text-3xl">😢</span>
                            <span class="text-[11px] font-medium">Sedih</span>
                        </div>
                        <div class="growmate-mood-card cursor-pointer"
                             :class="{ 'selected': selected === 'stres' }"
                             @click="selected = 'stres'">
                            <span class="text-3xl">😤</span>
                            <span class="text-[11px] font-medium">Stres</span>
                        </div>
                        <div class="growmate-mood-card cursor-pointer"
                             :class="{ 'selected': selected === 'lelah' }"
                             @click="selected = 'lelah'">
                            <span class="text-3xl">😴</span>
                            <span class="text-[11px] font-medium">Lelah</span>
                        </div>
                        <div class="growmate-mood-card cursor-pointer"
                             :class="{ 'selected': selected === 'termotivasi' }"
                             @click="selected = 'termotivasi'">
                            <span class="text-3xl">💪</span>
                            <span class="text-[11px] font-medium">Semangat</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-[11px] font-medium text-label block mb-1.5">Catatan (opsional)</label>
                        <textarea x-model="note" placeholder="Tulis apa yang kamu rasakan..."
                                  class="growmate-input min-h-[100px] resize-none"></textarea>
                    </div>

                    <button type="submit" class="growmate-btn-primary h-[50px]" :disabled="!selected">
                        Simpan Mood
                    </button>
                </form>
            </div>

            <div>
                <div class="section-header mt-6 lg:mt-0">
                    <h3 class="growmate-heading">Riwayat Mood</h3>
                </div>
                @if($history->count() > 0)
                    <div class="space-y-2">
                        @foreach($history as $log)
                            <div class="stat-card flex items-center gap-3">
                                <span class="text-2xl">
                                    @switch($log->mood)
                                        @case('senang') 😊 @break
                                        @case('biasa') 😐 @break
                                        @case('sedih') 😢 @break
                                        @case('stres') 😤 @break
                                        @case('lelah') 😴 @break
                                        @case('termotivasi') 💪 @break
                                        @default 🙂
                                    @endswitch
                                </span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[13px] font-medium capitalize">{{ $log->mood }}</p>
                                    @if($log->note)
                                        <p class="text-[10px] text-soft-text truncate">{{ $log->note }}</p>
                                    @endif
                                </div>
                                <span class="text-[10px] text-soft-text flex-shrink-0">{{ $log->date->format('d M') }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">📊</div>
                        <p class="empty-state-title">Belum ada catatan mood</p>
                        <p class="empty-state-desc">Mulai catat mood kamu hari ini!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
