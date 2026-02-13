<section class="space-y-6">

    <header>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
            เปลี่ยนรหัสผ่าน
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            เพื่อความปลอดภัย กรุณาใช้รหัสผ่านที่คาดเดาได้ยาก
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" value="รหัสผ่านปัจจุบัน" />
            <x-text-input
                id="current_password"
                name="current_password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="current-password" />
            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="รหัสผ่านใหม่" />
            <x-text-input
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="ยืนยันรหัสผ่านใหม่" />
            <x-text-input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                บันทึกการเปลี่ยนแปลง
            </x-primary-button>

            @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 dark:text-green-400">
                เปลี่ยนรหัสผ่านสำเร็จ
            </p>
            @endif
        </div>
    </form>

</section>