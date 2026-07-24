<section class="max-w-4xl mx-auto rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-900/5 dark:bg-gray-800 dark:ring-white/10 sm:p-8">
    
    <!-- Header -->
    <header class="flex items-center gap-4 border-b border-slate-100 pb-5 dark:border-gray-700/60">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-teal-50 text-teal-600 dark:bg-teal-950/50 dark:text-teal-400">
            <i class="bi bi-shield-lock text-xl"></i>
        </div>
        <div>
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">
                เปลี่ยนรหัสผ่าน
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                เพื่อความปลอดภัย กรุณาใช้รหัสผ่านที่คาดเดาได้ยากและไม่ซ้ำกับบริการอื่น
            </p>
        </div>
    </header>

    <!-- Form -->
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- รหัสผ่านปัจจุบัน -->
        <div>
            <x-input-label for="current_password" value="รหัสผ่านปัจจุบัน" class="text-slate-700 dark:text-slate-300 font-medium" />
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                    <i class="bi bi-key"></i>
                </span>
                <x-text-input
                    id="current_password"
                    name="current_password"
                    type="password"
                    class="block w-full rounded-xl border-slate-200 pl-10 focus:border-teal-500 focus:ring-teal-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                    autocomplete="current-password" />
            </div>
            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2" />
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- รหัสผ่านใหม่ -->
            <div>
                <x-input-label for="password" value="รหัสผ่านใหม่" class="text-slate-700 dark:text-slate-300 font-medium" />
                <div class="relative mt-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="bi bi-lock"></i>
                    </span>
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full rounded-xl border-slate-200 pl-10 focus:border-teal-500 focus:ring-teal-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                        autocomplete="new-password" />
                </div>
                <x-input-error
                    :messages="$errors->updatePassword->get('password')"
                    class="mt-2" />
            </div>

            <!-- ยืนยันรหัสผ่านใหม่ -->
            <div>
                <x-input-label for="password_confirmation" value="ยืนยันรหัสผ่านใหม่" class="text-slate-700 dark:text-slate-300 font-medium" />
                <div class="relative mt-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <x-text-input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="block w-full rounded-xl border-slate-200 pl-10 focus:border-teal-500 focus:ring-teal-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                        autocomplete="new-password" />
                </div>
                <x-input-error
                    :messages="$errors->updatePassword->get('password_confirmation')"
                    class="mt-2" />
            </div>
        </div>

        <!-- Action Buttons & Status (จัดชิดขวา) -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-100 dark:border-gray-700/60">
            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="inline-flex items-center text-sm font-medium text-emerald-600 dark:text-emerald-400">
                    <i class="bi bi-check-circle-fill me-1.5"></i> เปลี่ยนรหัสผ่านสำเร็จ
                </p>
            @endif

            <x-primary-button class="inline-flex items-center justify-center rounded-xl bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-teal-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600 transition">
                บันทึกการเปลี่ยนแปลง
            </x-primary-button>
        </div>
    </form>
</section>