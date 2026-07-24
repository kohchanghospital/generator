<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base sm:text-lg text-slate-800 dark:text-slate-100 truncate">
            {{ __('โปรไฟล์ผู้ใช้งาน') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <!-- ส่วนอัปเดตข้อมูลส่วนตัว -->
            <div class="bg-transparent">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- ส่วนเปลี่ยนรหัสผ่าน -->
            <div class="bg-transparent">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
</x-app-layout>