{{-- GrowMate: App Layout (responsive: mobile bottom nav, desktop sidebar) --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'GrowMate'))</title>
    <link rel="icon" type="image/png" href="{{ asset('images/growmate-logo.png') }}">
    {{-- Font Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-layout bg-[#F9FAFB] text-black font-poppins" x-data="growmateApp" x-init="init()">
    {{-- Desktop: flex container for sidebar + main content --}}
    <div class="lg:flex lg:min-h-screen">
        {{-- Sidebar Navigation — desktop only --}}
        @include('layouts.sidebar')

        {{-- Main Content Area — offset by sidebar width on desktop --}}
        <div class="flex-1 lg:pl-64">
            {{-- Phone-like container on mobile, full width on desktop --}}
            <div class="min-h-screen max-w-mobile lg:max-w-none mx-auto lg:mx-0 bg-white shadow-2xl lg:shadow-none relative pb-nav lg:pb-0">
                {{-- Top Bar with Notification Bell --}}
                <div class="sticky top-0 z-40 bg-white/95 backdrop-blur-lg border-b border-gray-100">
                    <div class="flex items-center justify-end px-page py-3">
                        @auth
                            <a href="{{ route('notification.index') }}" class="relative p-2 -mr-2">
                                <svg class="w-5 h-5 text-soft-text hover:text-black transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                @if($unreadNotificationCount > 0)
                                    <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 text-white text-[8px] font-bold rounded-full flex items-center justify-center">{{ $unreadNotificationCount > 9 ? '9+' : $unreadNotificationCount }}</span>
                                @endif
                            </a>
                        @endauth
                    </div>
                </div>

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="mx-page mt-3 px-4 py-3 bg-green-50 border border-green-200 rounded-xl text-[12px] text-green-700 font-medium">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mx-page mt-3 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-[12px] text-red-600 font-medium">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Main Content --}}
                <main class="pb-2">
                    {{ $slot }}
                </main>

                {{-- AI Chat FAB — mobile only --}}
                <a href="{{ route('ai-chat.index') }}"
                   class="fixed bottom-[88px] right-4 z-50 w-12 h-12 rounded-full bg-gradient-to-br from-primary to-primary-dark text-white shadow-lg flex items-center justify-center hover:scale-110 transition-all duration-200 active:scale-95 lg:hidden"
                   style="left: 50%; transform: translateX(calc(215px - 50%));">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12z"/><path d="M11 12h2v2h-2zm0-6h2v4h-2z"/></svg>
                </a>

                {{-- Bottom Navigation — mobile only --}}
                @include('layouts.navigation-bottom')
            </div>
        </div>
    </div>
</body>
</html>
