<div>
    <!-- Modal Background -->
    <div
        x-show="open"
        x-transition
        class="fixed inset-0 bg-black bg-opacity-50 z-40"
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
                        : '{{ url('checklist') }}/' + current.id"
                >
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
                                    focus:ring-2 focus:ring-green-500 focus:outline-none"
                            >
                        </div>
                        {{-- สถานะ --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium">สถานะ :</label>
                            <div class="flex items-center gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input checked type="radio" name="status" value="1"
                                        x-model="current.status"
                                        class="text-green-600 focus:ring-green-500">
                                    <span>เปิดใช้งาน</span>
                                </label>

                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="2"
                                        x-model="current.status"
                                        class="text-red-600 focus:ring-red-500">
                                    <span>ปิดใช้งาน</span>
                                </label>
                            </div>
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
                                text-white font-semibold rounded-lg"
                        >
                            <span x-show="mode === 'create'">บันทึกข้อมูล</span>
                            <span x-show="mode === 'edit'">อัปเดตข้อมูล</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
