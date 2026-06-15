{{-- GrowMate: Guest Layout — background gradient + decorative blobs --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'GrowMate'))</title>
    <link rel="icon" type="image/png" href="{{ asset('images/growmate-logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-primary/[0.07] via-background to-accent/[0.07] text-black font-poppins relative overflow-x-hidden" x-data x-init>
    <div class="fixed inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] rounded-full bg-primary/10 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] rounded-full bg-accent/10 blur-3xl"></div>
    </div>
    <div class="relative">
        {{ $slot }}
    </div>
</body>
</html>
