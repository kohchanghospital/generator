<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Generator</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('generator-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('generator-icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('generator-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=noto-sans-thai:300,400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased overflow-x-hidden bg-slate-100 dark:bg-gray-950">

    <div
        x-data="{
        sidebarOpen: localStorage.getItem('sidebarOpen') === 'false' ? false : true,
        mobileOpen: false
    }"
        x-init="$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', value))"
        class="min-h-screen flex flex-col bg-slate-100 text-slate-900 dark:bg-gray-950 dark:text-gray-100">

        {{-- Overlay (Mobile) --}}
        <div
            x-show="mobileOpen"
            @click="mobileOpen = false"
            class="fixed inset-0 bg-black/50 z-30 lg:hidden"
            x-transition></div>

        <div class="flex flex-1">
            {{-- Sidebar --}}
            @auth
            @include('layouts.sidebar')
            @endauth

            {{-- Content --}}
            <div class="flex min-w-0 flex-1 flex-col lg:ml-20">
                {{-- Top Navigation --}}
                @include('layouts.navigation')

                {{-- Page Heading --}}
                @isset($header)
                <header class="border-b border-slate-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <!-- <div class="mx-auto max-w-8xl px-4 py-4 sm:px-6 lg:px-8 lg:py-6">
                        {{ $header }}
                    </div> -->
                </header>
                @endisset

                {{-- Page Content --}}
                <main class="flex-1 p-4 pb-24 sm:p-6 lg:pb-6">
                    {{ $slot }}
                </main>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="bg-white py-4 pb-24 text-center text-sm text-slate-500 shadow-sm dark:bg-gray-900 dark:text-gray-400 lg:pl-20 lg:pb-4">
            © {{ date('Y') }} Kohchang Hospital. All rights reserved.
        </footer>

    </div>
</body>

</html>
