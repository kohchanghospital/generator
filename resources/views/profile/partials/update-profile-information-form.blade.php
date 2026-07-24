<section class="max-w-4xl mx-auto rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-900/5 dark:bg-gray-800 dark:ring-white/10 sm:p-8">
    
    <!-- Header -->
    <header class="flex items-center gap-4 border-b border-slate-100 pb-5 dark:border-gray-700/60">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-teal-50 text-teal-600 dark:bg-teal-950/50 dark:text-teal-400">
            <i class="bi bi-person-badge text-xl"></i>
        </div>
        <div>
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">
                ข้อมูลโปรไฟล์
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                อัปเดตข้อมูลส่วนตัว ชื่อผู้ใช้งาน และอีเมลของคุณ
            </p>
        </div>
    </header>

    <!-- Form -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- ชื่อ -->
            <div>
                <x-input-label for="name" value="ชื่อ" class="text-slate-700 dark:text-slate-300 font-medium" />
                <div class="relative mt-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="bi bi-person"></i>
                    </span>
                    <x-text-input id="name" name="name" type="text"
                        class="block w-full rounded-xl border-slate-200 pl-10 focus:border-teal-500 focus:ring-teal-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- ชื่อผู้ใช้งาน -->
            <div>
                <x-input-label for="username" value="ชื่อผู้ใช้งาน" class="text-slate-700 dark:text-slate-300 font-medium" />
                <div class="relative mt-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="bi bi-at"></i>
                    </span>
                    <x-text-input id="username" name="username" type="text"
                        class="block w-full rounded-xl border-slate-200 pl-10 focus:border-teal-500 focus:ring-teal-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                        :value="old('username', $user->username)" required autocomplete="username" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
            </div>
        </div>

        <!-- อีเมล -->
        <div>
            <x-input-label for="email" value="อีเมล" class="text-slate-700 dark:text-slate-300 font-medium" />
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                    <i class="bi bi-envelope"></i>
                </span>
                <x-text-input id="email" name="email" type="email"
                    class="block w-full rounded-xl border-slate-200 pl-10 focus:border-teal-500 focus:ring-teal-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                    :value="old('email', $user->email)" required autocomplete="email" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Action Buttons & Status (จัดชิดขวา) -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-100 dark:border-gray-700/60">
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="inline-flex items-center text-sm font-medium text-emerald-600 dark:text-emerald-400">
                    <i class="bi bi-check-circle-fill me-1.5"></i> บันทึกสำเร็จ
                </p>
            @endif

            <x-primary-button class="inline-flex items-center justify-center rounded-xl bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-teal-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600 transition">
                บันทึกข้อมูล
            </x-primary-button>
        </div>
    </form>
</section>