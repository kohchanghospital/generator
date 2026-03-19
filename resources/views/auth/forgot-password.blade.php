<x-guest-layout>
    <div class="mt-4 mb-4 text-xl text-center text-gray-600 dark:text-gray-400">
        <!-- {{ __('Forgot your password? No problem. Please contact your IT department for assistance.') }} -->
          <!-- Title -->
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">
                Forgot Password
            </h2>

            <!-- Description -->
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                {{ __('No worries! Please contact your IT department for assistance.') }}
            </p>
            <!-- Button -->
            <a href="{{ route('login') }}"
               class="inline-block w-full bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium py-2.5 rounded-lg transition">
                Back to Login
            </a>
    </div>

    <!-- Session Status -->
    <!-- <x-auth-session-status class="mb-4" :status="session('status')" /> -->

    <!-- <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> -->
</x-guest-layout>
