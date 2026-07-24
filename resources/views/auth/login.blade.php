<x-guest-layout>
    <div class="mb-6">
        <p class="text-sm font-medium text-teal-600 dark:text-teal-400">{{ __('Welcome back') }}</p>
        <h2 class="mt-2 text-2xl font-semibold text-slate-950 dark:text-white">{{ __('Log in to your account') }}</h2>
        <p class="mt-2 text-sm text-slate-500 dark:text-gray-400">{{ __('Enter your staff credentials to access the system.') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-5 rounded-xl bg-green-50 px-4 py-3 text-green-700 dark:bg-green-950/50 dark:text-green-300" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Username or Email -->
        <div>
            <x-input-label for="login" :value="__('Username or Email')" />
            <x-text-input id="login" class="mt-2 block min-h-11 w-full" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="mt-2 block min-h-11 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-teal-600 shadow-sm focus:ring-teal-500 dark:border-gray-700 dark:bg-gray-950 dark:focus:ring-teal-500 dark:focus:ring-offset-gray-900" name="remember">
                <span class="ms-2 text-sm text-slate-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col-reverse gap-4 pt-1 sm:flex-row sm:items-center sm:justify-between">
            @if (Route::has('password.request'))
            <a class="text-center text-sm font-medium text-slate-600 hover:text-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-teal-300 dark:focus:ring-offset-gray-900 sm:text-left" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="w-full justify-center rounded-xl bg-teal-600 px-5 py-3 text-sm hover:bg-teal-700 focus:bg-teal-700 focus:ring-teal-500 sm:w-auto">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <!-- <div class="mt-4 text-center">
            <a href="{{ url('/auth/google') }}"
                class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                Login with Google
            </a>
        </div> -->
    </form>
</x-guest-layout>
