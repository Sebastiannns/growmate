{{-- GrowMate: Focus Timer (timer.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20" x-data="focusTimer()">
        <div class="page-header text-center">
            <div>
                <p class="text-sm text-soft-text">Focus Timer</p>
                <h1>Fokus belajar dengan teknik Pomodoro</h1>
            </div>
        </div>

        <div class="flex justify-center gap-3 mb-8">
            <template x-for="(preset, key) in presets" :key="key">
                <button @click="setMode(key)"
                        class="px-4 py-2 rounded-xl text-[11px] lg:text-xs font-medium transition-all duration-200"
                        :class="mode === key ? 'bg-primary text-white shadow-md' : 'bg-gray-100 text-soft-text hover:bg-gray-200'"
                        x-text="preset.label">
                </button>
            </template>
        </div>

        <div class="flex justify-center mb-8">
            <div class="relative w-56 h-56 lg:w-64 lg:h-64">
                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 224 224">
                    <circle cx="112" cy="112" r="100" fill="none" stroke="#F3F4F6" stroke-width="8" />
                    <circle cx="112" cy="112" r="100" fill="none" stroke="#94BBFA" stroke-width="8"
                            stroke-linecap="round"
                            :stroke-dasharray="circumference"
                            :stroke-dashoffset="progressOffset"
                            class="transition-all duration-1000 ease-linear" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent" x-text="display"></span>
                    <span class="text-[11px] lg:text-xs text-soft-text mt-1" x-text="statusLabel"></span>
                </div>
            </div>
        </div>

        <div class="flex justify-center gap-4 mb-8">
            <button @click="startTimer" x-show="status === 'idle' || status === 'paused'"
                    class="w-16 h-16 rounded-full bg-gradient-to-r from-primary to-primary-dark text-white shadow-lg flex items-center justify-center hover:shadow-xl hover:shadow-primary/20 transition-all duration-200 active:scale-95">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </button>
            <button @click="pauseTimer" x-show="status === 'running'"
                    class="w-16 h-16 rounded-full bg-yellow-400 text-white shadow-lg flex items-center justify-center hover:bg-yellow-500 transition-all duration-200 active:scale-95">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"/></svg>
            </button>
            <button @click="resetTimer"
                    class="w-16 h-16 rounded-full bg-gray-200 text-soft-text shadow flex items-center justify-center hover:bg-gray-300 transition-all duration-200 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </button>
        </div>

        <div class="stat-card">
            <div class="section-header">
                <h3 class="growmate-heading">Sesi Hari Ini</h3>
                <span class="text-[10px] text-soft-text" x-text="sessionCount + ' sesi selesai'"></span>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <template x-for="i in Math.min(sessionCount, 8)" :key="i">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                        <span class="text-xs">🍅</span>
                    </div>
                </template>
                <template x-if="sessionCount === 0">
                    <p class="text-[11px] text-soft-text">Belum ada sesi fokus hari ini</p>
                </template>
            </div>
        </div>
    </div>

    <script>
        function focusTimer() {
            return {
                mode: 'focus',
                presets: {
                    focus: { label: 'Fokus', minutes: 25 },
                    short: { label: 'Istirahat', minutes: 5 },
                    long: { label: 'Panjang', minutes: 15 },
                },
                timeLeft: 25 * 60,
                totalTime: 25 * 60,
                status: 'idle',
                sessionCount: {{ $todayCount }},
                timerInterval: null,
                circumference: 2 * Math.PI * 100,

                get display() {
                    const m = Math.floor(this.timeLeft / 60);
                    const s = this.timeLeft % 60;
                    return `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
                },

                get progressOffset() {
                    return this.circumference * (this.timeLeft / this.totalTime);
                },

                get statusLabel() {
                    if (this.status === 'running') return 'Fokus...';
                    if (this.status === 'paused') return 'Dijeda';
                    if (this.status === 'completed') return 'Selesai!';
                    return 'Siap mulai';
                },

                setMode(key) {
                    if (this.status === 'running') return;
                    this.mode = key;
                    this.timeLeft = this.presets[key].minutes * 60;
                    this.totalTime = this.timeLeft;
                    this.status = 'idle';
                },

                startTimer() {
                    if (this.timeLeft <= 0) return;
                    this.status = 'running';
                    this.timerInterval = setInterval(() => {
                        if (this.timeLeft > 0) {
                            this.timeLeft--;
                        } else {
                            this.completeTimer();
                        }
                    }, 1000);
                },

                pauseTimer() {
                    this.status = 'paused';
                    clearInterval(this.timerInterval);
                },

                resetTimer() {
                    clearInterval(this.timerInterval);
                    this.timeLeft = this.presets[this.mode].minutes * 60;
                    this.totalTime = this.timeLeft;
                    this.status = 'idle';
                },

                completeTimer() {
                    clearInterval(this.timerInterval);
                    this.status = 'completed';
                    this.sessionCount++;
                    this.saveSession();
                },

                saveSession() {
                    fetch('{{ route('timer.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            mode: this.mode,
                            duration: this.totalTime,
                        }),
                    });
                },
            }
        }
    </script>
</x-app-layout>
