{{-- GrowMate: Notifikasi --}}
<x-app-layout>
    <div class="growmate-container pt-6 pb-20">
        <div class="page-header">
            <div>
                <p class="text-sm text-soft-text">Notifikasi</p>
                <h1>Pemberitahuan dan aktivitas</h1>
            </div>
            @if($notifications->where('is_read', false)->count() > 0)
                <form method="POST" action="{{ route('notification.readAll') }}">
                    @csrf
                    <button type="submit" class="text-[10px] lg:text-xs text-primary font-semibold hover:underline">Tandai semua dibaca</button>
                </form>
            @endif
        </div>

        @if($notifications->count() > 0)
            <div class="space-y-2">
                @foreach($notifications as $notif)
                    <a href="{{ $notif->is_read ? ($notif->url ?: '#') : route('notification.read', $notif) }}"
                       class="block stat-card hover:bg-gray-50 transition-colors {{ !$notif->is_read ? 'border-l-4 border-primary' : '' }}">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full
                                @if($notif->type === 'success') bg-green-100
                                @elseif($notif->type === 'warning') bg-yellow-100
                                @elseif($notif->type === 'danger') bg-red-100
                                @else bg-primary/10
                                @endif flex items-center justify-center flex-shrink-0 text-sm">
                                @if($notif->type === 'success') &#9989;
                                @elseif($notif->type === 'warning') &#9888;&#65039;
                                @elseif($notif->type === 'danger') &#10060;
                                @else &#8505;&#65039;
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[13px] font-medium {{ !$notif->is_read ? 'text-black' : 'text-soft-text' }}">{{ $notif->title }}</p>
                                @if($notif->body)
                                    <p class="text-[11px] text-soft-text mt-0.5">{{ $notif->body }}</p>
                                @endif
                                <p class="text-[9px] text-soft-text mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                            </div>
                            @if(!$notif->is_read)
                                <span class="w-2 h-2 rounded-full bg-primary flex-shrink-0 mt-2"></span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">🔔</div>
                <p class="empty-state-title">Belum ada notifikasi</p>
                <p class="empty-state-desc">Akan muncul saat ada aktivitas baru</p>
            </div>
        @endif
    </div>
</x-app-layout>
