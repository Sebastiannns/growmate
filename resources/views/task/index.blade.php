{{-- GrowMate: Task Management (to do list.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="page-header">
            <div>
                <p class="text-sm text-soft-text">Tugas Saya</p>
                <h1>Kelola tugas akademikmu</h1>
                <p class="text-[11px] text-soft-text mt-1">Catat dan lacak progress tugas kuliahmu.</p>
            </div>
            <span class="text-sm text-soft-text">{{ $tasks->where('status', '!=', 'completed')->count() }} tersisa</span>
        </div>

        @php
            $total = $tasks->count();
            $completed = $tasks->where('status', 'completed')->count();
            $progress = $total > 0 ? round(($completed / $total) * 100) : 0;
        @endphp
        <div class="stat-card mb-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white font-bold text-base shadow-md flex-shrink-0">
                    {{ $progress }}%
                </div>
                <div class="flex-1">
                    <div class="flex justify-between text-[11px] lg:text-xs mb-1">
                        <span class="font-medium">Progress Tugas</span>
                        <span class="text-soft-text">{{ $completed }}/{{ $total }} tugas</span>
                    </div>
                    <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-primary to-primary-dark rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div x-data="{ open: false }" class="mb-6">
                <button @click="open = !open" class="growmate-btn-primary h-[46px] mb-3">
                    <span x-text="open ? '− Tutup' : '+ Tambah Tugas'">+ Tambah Tugas</span>
                </button>

            <form method="POST" action="{{ route('task.store') }}" x-show="open" x-transition.duration.200ms class="stat-card space-y-3">
                @csrf
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Judul Tugas</label>
                    <input type="text" name="title" placeholder="Masukkan nama tugas" class="growmate-input" required>
                    @error('title') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Deskripsi (opsional)</label>
                    <textarea name="description" placeholder="Detail tugas..." class="growmate-input min-h-[80px] resize-none"></textarea>
                    @error('description') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-[11px] font-medium text-label block mb-1.5">Deadline</label>
                    <input type="date" name="deadline" class="growmate-input">
                    @error('deadline') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="growmate-btn-primary h-[46px]">Simpan Tugas</button>
            </form>
        </div>

        @if($tasks->count() > 0)
            <div class="space-y-2">
                @foreach($tasks as $task)
                    <div class="stat-card flex items-start gap-3">
                        <form method="POST" action="{{ route('task.update', $task) }}" class="mt-0.5">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="{{ $task->status === 'completed' ? 'pending' : 'completed' }}">
                            <button type="submit" class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-all duration-200"
                                    style="border-color: {{ $task->status === 'completed' ? '#94BBFA' : '#D1D5DB' }}; background: {{ $task->status === 'completed' ? '#94BBFA' : 'transparent' }}">
                                @if($task->status === 'completed')
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                @endif
                            </button>
                        </form>
                        <div class="flex-1 min-w-0">
                            <p class="text-[13px] font-medium {{ $task->status === 'completed' ? 'line-through text-soft-text' : '' }}">
                                {{ $task->title }}
                            </p>
                            @if($task->description)
                                <p class="text-[10px] text-soft-text mt-0.5">{{ $task->description }}</p>
                            @endif
                            <div class="flex items-center gap-2 mt-1.5">
                                @if($task->deadline)
                                    <span class="text-[10px] text-soft-text">
                                        📅 {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                    </span>
                                @endif
                                <span class="growmate-badge
                                    @if($task->status === 'completed') bg-green-100 text-green-600
                                    @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-600
                                    @else bg-gray-100 text-gray-500
                                    @endif">
                                    @if($task->status === 'completed') Selesai
                                    @elseif($task->status === 'in_progress') Diproses
                                    @else Menunggu
                                    @endif
                                </span>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('task.destroy', $task) }}" onsubmit="return confirm('Hapus tugas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📋</div>
                <p class="empty-state-title">Belum ada tugas</p>
                <p class="empty-state-desc">Tambahkan tugas pertama kamu!</p>
            </div>
        @endif
    </div>
</x-app-layout>
