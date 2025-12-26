<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=noto-sans-thai:300,400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased overflow-x-hidden">

<div
    x-data="{
        sidebarOpen: localStorage.getItem('sidebarOpen') === 'false' ? false : true,
        mobileOpen: false
    }"
    x-init="$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', value))"
    class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900"
>

    {{-- Overlay (Mobile) --}}
    <div
        x-show="mobileOpen"
        @click="mobileOpen = false"
        class="fixed inset-0 bg-black/50 z-30 lg:hidden"
        x-transition
    ></div>

    <div class="flex flex-1">
        {{-- Sidebar --}}
        @auth
            @include('layouts.sidebar')
        @endauth

        {{-- Content --}}
        <div class="ml-20 flex-1 flex flex-col">
            {{-- Top Navigation --}}
            @include('layouts.navigation')

            {{-- Page Heading --}}
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-8xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Page Content --}}
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="py-4 text-center text-sm text-gray-400 bg-white dark:bg-gray-800 shadow">
        © {{ date('Y') }} Kohchang Hospital. All rights reserved.
    </footer>

</div>
</body>
</html>
