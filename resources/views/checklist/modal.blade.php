<div>
    <!-- Modal Background -->
    <div
        x-show="open"
        x-transition
        class="fixed inset-0 bg-black/30 backdrop-blur-[4px] z-40"
        @click="open = false">
    </div>

    <!-- Modal -->
    <div
        x-show="open"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center px-4">

        <div class="bg-white dark:bg-gray-800 w-full max-w-4xl rounded-lg shadow-lg">

            <!-- Header -->
            <div class="flex justify-between items-center px-6 py-4 border-b dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                    <span x-show="mode === 'create'">บันทึกข้อมูลการตรวจเช็คใหม่</span>
                    <span x-show="mode === 'edit'">แก้ไขรายการตรวจเช็ค</span>
                </h2>
                <button @click="open = false" class="text-gray-500 hover:text-red-500 text-xl">
                    ✕
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <form
                    method="POST"
                    :action="mode === 'create'
                        ? '{{ route('checklist.store') }}'
                        : '{{ url('checklist') }}/' + current.id">
                    @csrf
                    <template x-if="mode === 'edit'">
                        @method('PUT')
                    </template>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6 items-end">

                        {{-- รายการตรวจเช็ค --}}
                        <div class="md:col-span-3">
                            <label class="block mb-2 text-sm font-medium">
                                รายการตรวจเช็ค :
                            </label>
                            <input
                                type="text"
                                name="checklist_name"
                                x-model="current.checklist_name"
                                required
                                placeholder="กรอกรายการตรวจเช็ค"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                    bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                    focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>
                        {{-- สถานะ --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium">สถานะ :</label>
                            <label
                                class="relative inline-flex items-center cursor-pointer"
                                :class="mode === 'view' ? 'opacity-60 cursor-not-allowed' : ''">
                                <!-- Hidden checkbox -->
                                <input
                                    type="checkbox"
                                    class="sr-only"
                                    :checked="current.is_active == 1"
                                    @change="current.is_active = $event.target.checked ? 1 : 0"
                                    :disabled="mode === 'view'">
                                <!-- Switch background -->
                                <div
                                    class="w-11 h-6 rounded-full transition-colors"
                                    :class="current.is_active == 1
                                            ? 'bg-green-600'
                                            : 'bg-gray-300 dark:bg-gray-600'"></div>
                                <!-- Switch knob -->
                                <div
                                    class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform"
                                    :class="current.is_active == 1 ? 'translate-x-5' : ''"></div>
                                <!-- Label text -->
                                <span class="ml-3 text-sm font-medium"
                                    x-text="current.is_active == 1 ? 'เปิดใช้งาน' : 'ปิดใช้งาน'">
                                </span>
                            </label>
                            <!-- hidden input เพื่อส่งค่าไป backend -->
                            <input type="hidden" name="is_active" :value="current.is_active">
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end gap-3">
                        <button
                            type="button"
                            @click="open = false"
                            class="px-5 py-2 rounded-lg border border-gray-300 dark:border-gray-600">
                            ยกเลิก
                        </button>

                        <button
                            type="submit"
                            class="px-6 py-2 bg-green-600 hover:bg-green-700
                                text-white font-semibold rounded-lg">
                            <span x-show="mode === 'create'">บันทึกข้อมูล</span>
                            <span x-show="mode === 'edit'">อัปเดตข้อมูล</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>