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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen bg-slate-50 text-slate-900 dark:bg-gray-950 dark:text-gray-100">
        <div class="mx-auto flex min-h-screen w-full max-w-6xl flex-col justify-center px-4 py-8 sm:px-6 lg:grid lg:grid-cols-[1fr_440px] lg:gap-12 lg:px-8">
            <section class="hidden lg:flex lg:flex-col lg:justify-center">
                <a href="{{ url('/') }}" class="mb-8 inline-flex items-center gap-4">
                    <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 dark:bg-gray-900 dark:ring-gray-800">
                        <x-application-logo class="h-12 w-auto" />
                    </span>
                    <span>
                        <span class="block text-2xl font-semibold text-slate-950 dark:text-white">Generator</span>
                        <span class="block text-sm text-slate-500 dark:text-gray-400">Kohchang Hospital</span>
                    </span>
                </a>

                <div class="max-w-xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-400">Paperless Generator Inspection Portal.</p>
                    <h1 class="mt-4 text-4xl font-semibold leading-tight text-slate-950 dark:text-white">
                        Modernizing hospital power system records.
                    </h1>
                    <p class="mt-5 text-base leading-7 text-slate-600 dark:text-gray-300">
                        Sign in to access digital inspection lists, monitor operation schedules, and manage generator logs securely.
                    </p>
                </div>
            </section>

            <main class="flex w-full flex-1 items-center justify-center lg:flex-none">
                <div class="w-full max-w-md">
                    <div class="mb-6 flex justify-center lg:hidden">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                            <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 dark:bg-gray-900 dark:ring-gray-800">
                                <x-application-logo class="h-10 w-auto" />
                            </span>
                            <span class="text-xl font-semibold text-slate-950 dark:text-white">Generator</span>
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-xl shadow-slate-200/60 dark:border-gray-800 dark:bg-gray-900 dark:shadow-black/20 sm:p-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>