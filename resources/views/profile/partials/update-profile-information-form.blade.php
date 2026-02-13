<section class="space-y-6">

    <header>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
            ข้อมูลโปรไฟล์
        </h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            อัปเดตข้อมูลส่วนตัวและอีเมลของคุณ
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="ชื่อผู้ใช้งาน" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="อีเมล" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                บันทึกข้อมูล
            </x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 dark:text-green-400">
                บันทึกสำเร็จ
            </p>
            @endif
        </div>
    </form>
</section>