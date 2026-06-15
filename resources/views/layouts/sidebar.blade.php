{{-- GrowMate: Desktop Sidebar Navigation --}}
<aside class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 lg:bg-white lg:border-r lg:border-gray-200 lg:z-50">
    {{-- Logo --}}
    <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-100">
        <div class="w-9 h-9 rounded-xl bg-primary shadow-sm flex items-center justify-center flex-shrink-0">
            <img src="{{ asset('images/growmate-logo.png') }}" alt="GrowMate" class="w-full h-full object-contain p-0.5">
        </div>
        <span class="text-lg font-bold text-black">GrowMate</span>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        @php $role = auth()->user()->role; @endphp

        @if($role === 'counselor')
            {{-- Counselor Nav --}}
            <a href="{{ route('counselor.dashboard') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'home' }" @click="$store.app.setActiveTab('home')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8"/></svg>
                <span>Home</span>
            </a>
            <a href="{{ route('counselor.schedule') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'schedule' }" @click="$store.app.setActiveTab('schedule')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Jadwal</span>
            </a>
            <a href="{{ route('counselor.articles') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'articles' }" @click="$store.app.setActiveTab('articles')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <span>Artikel</span>
            </a>
            <a href="{{ route('profile.show') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'profile' }" @click="$store.app.setActiveTab('profile')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>Profil</span>
            </a>
        @elseif($role === 'admin')
            {{-- Admin Nav --}}
            <a href="{{ route('admin.dashboard') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'home' }" @click="$store.app.setActiveTab('home')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8"/></svg>
                <span>Home</span>
            </a>
            <a href="{{ route('admin.users') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'users' }" @click="$store.app.setActiveTab('users')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.community') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'community' }" @click="$store.app.setActiveTab('community')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Forum</span>
            </a>
            <a href="{{ route('admin.materials') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'materials' }" @click="$store.app.setActiveTab('materials')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span>Materi</span>
            </a>
        @else
            {{-- Student Nav --}}
            <a href="{{ route('dashboard') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'home' }" @click="$store.app.setActiveTab('home')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8"/></svg>
                <span>Home</span>
            </a>
            <a href="{{ route('mood.index') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'mood' }" @click="$store.app.setActiveTab('mood')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Mood Tracker</span>
            </a>
            <a href="{{ route('task.index') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'task' }" @click="$store.app.setActiveTab('task')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                <span>Tugas</span>
            </a>
            <a href="{{ route('timer.index') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'timer' }" @click="$store.app.setActiveTab('timer')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Focus Timer</span>
            </a>
            <a href="{{ route('community.index') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'community' }" @click="$store.app.setActiveTab('community')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Komunitas</span>
            </a>
            <a href="{{ route('consultation.index') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'consultation' }" @click="$store.app.setActiveTab('consultation')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <span>Konsultasi</span>
            </a>
            <a href="{{ route('material.index') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'material' }" @click="$store.app.setActiveTab('material')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span>Materi</span>
            </a>
            <a href="{{ route('ai-chat.index') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'ai-chat' }" @click="$store.app.setActiveTab('ai-chat')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                <span>AI Chat</span>
            </a>
            <a href="{{ route('analytics.index') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'analytics' }" @click="$store.app.setActiveTab('analytics')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                <span>Analitik</span>
            </a>
            <div class="border-t border-gray-100 my-2"></div>
            <a href="{{ route('profile.show') }}" class="growmate-sidebar-item" :class="{ 'active': $store.app.activeTab === 'profile' }" @click="$store.app.setActiveTab('profile')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>Profil</span>
            </a>
        @endif
    </nav>

    {{-- User Info & Logout --}}
    <div class="border-t border-gray-100 p-4">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm flex-shrink-0">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-black truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-soft-text truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>
