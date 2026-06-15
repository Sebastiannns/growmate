{{-- GrowMate: AI Chat (chat Ai.png) --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20" x-data="{ message: '' }">
        <div class="page-header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white font-bold text-sm flex-shrink-0 shadow-md">
                    AI
                </div>
                <div>
                    <p class="text-sm text-soft-text">AI Asisten</p>
                    <h1>Teman bicara dan motivasimu</h1>
                </div>
            </div>
        </div>

        <div class="space-y-3 mb-4 max-h-[55vh] lg:max-h-[65vh] overflow-y-auto" x-ref="chatbox" x-init="$nextTick(() => $refs.chatbox.scrollTop = $refs.chatbox.scrollHeight)">
            @forelse($messages as $msg)
                <div class="flex {{ $msg->sender === 'user' ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[80%] rounded-2xl px-4 py-3 {{ $msg->sender === 'user' ? 'bg-gradient-to-r from-primary to-primary-dark text-white rounded-br-md shadow-md' : 'bg-gray-100 text-black rounded-bl-md' }}">
                        <p class="text-[13px] leading-relaxed">{{ $msg->message }}</p>
                        <p class="text-[9px] {{ $msg->sender === 'user' ? 'text-white/60' : 'text-soft-text' }} mt-1">{{ $msg->created_at->format('H:i') }}</p>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">🤖</div>
                    <p class="empty-state-title">Halo! Aku GrowMate AI</p>
                    <p class="empty-state-desc">Tanyakan apa saja atau ceritakan perasaanmu!</p>
                </div>
            @endforelse
        </div>

        <form method="POST" action="{{ route('ai-chat.send') }}"
              @submit="$nextTick(() => { message = ''; $refs.chatbox.scrollTop = $refs.chatbox.scrollHeight; })">
            @csrf
            <div class="flex gap-2 bg-white rounded-2xl p-2 shadow-card border border-border">
                <input type="text" name="message" x-model="message" placeholder="Ketik pesan..." class="flex-1 text-[13px] px-3 py-2 outline-none bg-transparent" required>
                <button type="submit" class="w-10 h-10 rounded-xl bg-gradient-to-r from-primary to-primary-dark text-white flex items-center justify-center flex-shrink-0 hover:shadow-lg hover:shadow-primary/20 transition-all duration-200 active:scale-95"
                        :disabled="!message.trim()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
