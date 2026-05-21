<div>
    <!-- Modal Background -->
    <div x-show="open" x-transition x-cloak class="fixed inset-0 bg-black/30 backdrop-blur-[4px] z-40" @click="open = false">
    </div>

    <!-- Modal -->
    <div x-show="open" x-transition x-cloak class="fixed inset-0 z-50 flex items-end justify-center overflow-y-auto p-3 sm:items-center sm:p-6">

        <div class="flex max-h-[calc(100vh-1.5rem)] w-full max-w-4xl flex-col overflow-hidden rounded-2xl bg-white shadow-xl dark:bg-gray-800 sm:max-h-[calc(100vh-3rem)]">

            <!-- Header -->
            <div class="flex items-start justify-between gap-4 border-b px-4 py-4 dark:border-gray-700 sm:px-6">
                <h2 class="text-base font-semibold text-gray-800 dark:text-gray-200 sm:text-lg">
                    <span x-show="mode === 'view'">ดูข้อมูลเครื่องปั่นไฟ</span>
                    <span x-show="mode === 'create'">บันทึกข้อมูลเครื่องปั่นไฟใหม่</span>
                    <span x-show="mode === 'edit'">แก้ไขรายการเครื่องปั่นไฟ</span>
                </h2>
                <button type="button" @click="open = false" class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-gray-500 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-950/40">
                    ✕
                </button>
            </div>

            <!-- Body -->
            <div class="overflow-y-auto p-4 text-gray-900 dark:text-gray-100 sm:p-6">

                <form method="POST" :action="mode === 'create'
                        ? '{{ route('generator.store') }}'
                        : '{{ url('generator') }}/' + current.id">
                    @csrf
                    <template x-if="mode === 'edit'">
                        @method('PUT')
                    </template>

                    <fieldset :disabled="mode === 'view'" :class="mode === 'view'
                            ? 'opacity-70 grayscale pointer-events-none'
                            : ''">
                        <div class="mb-6 grid grid-cols-1 items-end gap-4 md:grid-cols-4 md:gap-6">
                            {{-- รหัสเครื่อง --}}
                            <div class="md:col-span-4">
                                <label class="block mb-2 text-sm font-medium">
                                    รหัสเครื่อง :
                                </label>
                                <input type="text" name="machine_code" x-model="current.machine_code" required placeholder="กรอกรหัสเครื่อง" class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                    bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                    focus:ring-2 focus:ring-green-500 focus:outline-none">
                            </div>
                            {{-- หมายเลยครุภัณฑ์ --}}
                            <div class="md:col-span-4">
                                <label class="block mb-2 text-sm font-medium">
                                    หมายเลยครุภัณฑ์ :
                                </label>
                                <input type="text" name="asset_no" x-model="current.asset_no" required placeholder="กรอกหมายเลยครุภัณฑ์" class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                    bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                    focus:ring-2 focus:ring-green-500 focus:outline-none">
                            </div>
                            {{-- ชื่อครุภัณฑ์ --}}
                            <div class="md:col-span-4">
                                <label class="block mb-2 text-sm font-medium">
                                    ชื่อครุภัณฑ์ :
                                </label>
                                <input type="text" name="asset_name" x-model="current.asset_name" required placeholder="กรอกชื่อครุภัณฑ์" class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                    bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                    focus:ring-2 focus:ring-green-500 focus:outline-none">
                            </div>
                            {{-- ยี่ห้อ --}}
                            <div class="md:col-span-4">
                                <label class="block mb-2 text-sm font-medium">
                                    ยี่ห้อ :
                                </label>
                                <input type="text" name="brand" x-model="current.brand" required placeholder="กรอกยี่ห้อ" class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                    bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                    focus:ring-2 focus:ring-green-500 focus:outline-none">
                            </div>
                            {{-- รายละเอียด --}}
                            <div class="md:col-span-4">
                                <label class="block mb-2 text-sm font-medium">
                                    รายละเอียด :
                                </label>
                                <textarea name="detail" x-model="current.detail" placeholder="กรอกรายละเอียด" rows="5" class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                    bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                    focus:ring-2 focus:ring-green-500 focus:outline-none"></textarea>
                            </div>
                            {{-- สถานะ --}}
                            <div>
                                <label class="block mb-2 text-sm font-medium">สถานะ :</label>
                                <label class="relative inline-flex items-center cursor-pointer" :class="mode === 'view' ? 'opacity-60 cursor-not-allowed' : ''">
                                    <!-- Hidden checkbox -->
                                    <input type="checkbox" class="sr-only" :checked="current.is_active == 1" @change="current.is_active = $event.target.checked ? 1 : 0" :disabled="mode === 'view'">
                                    <!-- Switch background -->
                                    <div class="w-11 h-6 rounded-full transition-colors" :class="current.is_active == 1
                                            ? 'bg-green-600'
                                            : 'bg-gray-300 dark:bg-gray-600'"></div>
                                    <!-- Switch knob -->
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform" :class="current.is_active == 1 ? 'translate-x-5' : ''"></div>
                                    <!-- Label text -->
                                    <span class="ml-3 text-sm font-medium" x-text="current.is_active == 1 ? 'เปิดใช้งาน' : 'ปิดใช้งาน'">
                                    </span>
                                </label>
                                <!-- hidden input เพื่อส่งค่าไป backend -->
                                <input type="hidden" name="is_active" :value="current.is_active">
                            </div>
                        </div>
                    </fieldset>
                    <!-- Footer -->
                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <button type="button" @click="open = false" class="w-full rounded-lg border border-gray-300 px-5 py-2 dark:border-gray-600 sm:w-auto">
                            <span x-show="mode !== 'view'">ยกเลิก</span>
                            <span x-show="mode === 'view'">ปิด</span>
                        </button>
                        <button x-show="mode !== 'view'" type="submit" class="w-full rounded-lg bg-green-600 px-6 py-2 font-semibold text-white hover:bg-green-700 sm:w-auto">
                            <span x-show="mode === 'create'">บันทึกข้อมูล</span>
                            <span x-show="mode === 'edit'">อัปเดตข้อมูล</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
