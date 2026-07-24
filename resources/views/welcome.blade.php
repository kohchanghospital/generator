<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Generator</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('generator-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('generator-icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('generator-icon.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=noto-sans-thai:300,400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased dark:bg-gray-950 dark:text-gray-100">
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col px-4 py-5 sm:px-6 lg:px-8">
        <header class="flex items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="flex min-w-0 items-center gap-3">
                <!-- <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 dark:bg-gray-900 dark:ring-gray-800">
                    <img src="{{ asset('assets/image/generator3d.webp') }}" alt="Generator" class="h-9 w-auto">
                </span> -->
                <span class="min-w-0">
                    <span class="block truncate text-lg font-semibold text-slate-950 dark:text-white">Generator</span>
                    <span class="block truncate text-xs text-slate-500 dark:text-gray-400">Kohchang Hospital</span>
                </span>
            </a>

            @if (Route::has('login'))
            <nav class="flex shrink-0 items-center gap-2">
                @auth
                <a href="{{ url('/dashboard') }}" class="rounded-xl bg-teal-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950">
                    Dashboard
                </a>
                @else
                <a href="{{ route('login') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-800 shadow-sm hover:border-teal-200 hover:text-teal-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:border-teal-900 dark:hover:text-teal-300 sm:inline-flex">
                    Log in
                </a>
                @if (Route::has('register'))
                <!-- <a href="{{ route('register') }}" class="hidden rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-800 shadow-sm hover:border-teal-200 hover:text-teal-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:border-teal-900 dark:hover:text-teal-300 sm:inline-flex">
                    Register
                </a> -->
                @endif
                @endauth
            </nav>
            @endif
        </header>

        <main class="grid flex-1 items-center gap-8 py-8 lg:grid-cols-[1fr_440px] lg:gap-12">
            <section class="order-2 lg:order-1">
                <div class="max-w-2xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-400">Digital Inspection Tracking for Koh Chang Hospital.</p>
                    <h1 class="mt-4 text-3xl font-semibold leading-tight text-slate-950 dark:text-white sm:text-5xl">
                        Transforming paper-based generator logs into a secure digital workspace.
                    </h1>
                    <p class="mt-5 text-base leading-7 text-slate-600 dark:text-gray-300">
                        Easily review, record, and track generator checklists from any device, replacing traditional paper logs with a seamless digital solution.
                    </p>
                </div>

                <!-- <div class="mt-8 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                        <i class="bi bi-clipboard2-check text-2xl text-teal-600 dark:text-teal-400"></i>
                        <p class="mt-3 text-sm font-semibold">Inspections</p>
                        <p class="mt-1 text-sm text-slate-500 dark:text-gray-400">Record and review checks.</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                        <i class="bi bi-calendar3 text-2xl text-sky-600 dark:text-sky-400"></i>
                        <p class="mt-3 text-sm font-semibold">Calendar</p>
                        <p class="mt-1 text-sm text-slate-500 dark:text-gray-400">Plan recurring work.</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                        <i class="bi bi-file-earmark-arrow-down text-2xl text-indigo-600 dark:text-indigo-400"></i>
                        <p class="mt-3 text-sm font-semibold">Reports</p>
                        <p class="mt-1 text-sm text-slate-500 dark:text-gray-400">Export clean PDFs.</p>
                    </div>
                </div> -->
            </section>

            <section class="order-1 sm:p-8 lg:order-2">
                    <img src="{{ asset('assets/image/generator3d.webp') }}" alt="Generator" class="h-100 w-auto">   
        </section>
            <!-- <section class="order-1 rounded-3xl border border-slate-200 bg-white p-5 shadow-xl shadow-slate-200/60 dark:border-gray-800 dark:bg-gray-900 dark:shadow-black/20 sm:p-8 lg:order-2">
                <div class="mb-6 flex items-center gap-4">
                    <img src="{{ asset('assets/image/generator3d.webp') }}" alt="Generator" class="h-16 w-auto">
                    <div>
                        <p class="text-sm font-medium text-teal-600 dark:text-teal-400">Welcome back</p>
                        <h2 class="text-2xl font-semibold text-slate-950 dark:text-white">Sign in</h2>
                    </div>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="login" :value="__('Username or Email')" />
                        <x-text-input id="login" class="mt-2 block min-h-11 w-full" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('login')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="mt-2 block min-h-11 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-teal-600 shadow-sm focus:ring-teal-500 dark:border-gray-700 dark:bg-gray-950 dark:focus:ring-offset-gray-900" name="remember">
                            <span class="ms-2 text-sm text-slate-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-slate-600 hover:text-teal-700 dark:text-gray-400 dark:hover:text-teal-300" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                        @endif
                    </div>

                    <x-primary-button class="w-full justify-center rounded-xl bg-teal-600 px-5 py-3 text-sm hover:bg-teal-700 focus:bg-teal-700 focus:ring-teal-500">
                        {{ __('Log in') }}
                    </x-primary-button>
                </form>
            </section> -->
        </main>
    </div>
</body>

</html>
