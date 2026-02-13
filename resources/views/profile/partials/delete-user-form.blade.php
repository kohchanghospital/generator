<section class="space-y-6 border border-red-300 dark:border-red-700 rounded-lg p-6 bg-red-50 dark:bg-red-900/20">

    <header>
        <h2 class="text-lg font-semibold text-red-600 dark:text-red-400">
            ลบบัญชีผู้ใช้งาน
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            เมื่อคุณลบบัญชี ข้อมูลทั้งหมดของคุณจะถูกลบอย่างถาวร
            กรุณาตรวจสอบให้แน่ใจก่อนดำเนินการ
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        ลบบัญชี
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-red-600 dark:text-red-400">
                ยืนยันการลบบัญชี
            </h2>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                การดำเนินการนี้ไม่สามารถย้อนกลับได้
                กรุณากรอกรหัสผ่านเพื่อยืนยันการลบบัญชีอย่างถาวร
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="รหัสผ่าน" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="กรอกรหัสผ่าน" />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    ยกเลิก
                </x-secondary-button>

                <x-danger-button>
                    ยืนยันการลบ
                </x-danger-button>
            </div>
        </form>
    </x-modal>

</section>