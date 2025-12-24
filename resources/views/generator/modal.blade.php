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
                    <span x-show="mode === 'create'">บันทึกข้อมูลเครื่องปั่นไฟใหม่</span>
                    <span x-show="mode === 'edit'">แก้ไขรายการเครื่องปั่นไฟ</span>
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
                        ? '{{ route('generator.store') }}'
                        : '{{ url('generator') }}/' + current.id"
                >
                    @csrf
                    <template x-if="mode === 'edit'">
                        @method('PUT')
                    </template>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6 items-end">

                        {{-- รหัสเครื่อง --}}
                        <div class="md:col-span-4">
                            <label class="block mb-2 text-sm font-medium">
                                รหัสเครื่อง :
                            </label>
                            <input
                                type="text"
                                name="machine_code"
                                x-model="current.machine_code"
                                required
                                placeholder="กรอกรหัสเครื่อง"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                    bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                    focus:ring-2 focus:ring-green-500 focus:outline-none"
                            >
                        </div>
                        {{-- หมายเลยครุภัณฑ์ --}}
                        <div class="md:col-span-4">
                            <label class="block mb-2 text-sm font-medium">
                                หมายเลยครุภัณฑ์ :
                            </label>
                            <input
                                type="text"
                                name="asset_no"
                                x-model="current.asset_no"
                                required
                                placeholder="กรอกหมายเลยครุภัณฑ์"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                    bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                    focus:ring-2 focus:ring-green-500 focus:outline-none"
                            >
                        </div>
                        {{-- ชื่อครุภัณฑ์ --}}
                        <div class="md:col-span-4">
                            <label class="block mb-2 text-sm font-medium">
                                ชื่อครุภัณฑ์ :
                            </label>
                            <input
                                type="text"
                                name="asset_name"
                                x-model="current.asset_name"
                                required
                                placeholder="กรอกชื่อครุภัณฑ์"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                    bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                    focus:ring-2 focus:ring-green-500 focus:outline-none"
                            >
                        </div>
                        {{-- ยี่ห้อ --}}
                        <div class="md:col-span-4">
                            <label class="block mb-2 text-sm font-medium">
                                ยี่ห้อ :
                            </label>
                            <input
                                type="text"
                                name="brand"
                                x-model="current.brand"
                                required
                                placeholder="กรอกยี่ห้อ"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                    bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                    focus:ring-2 focus:ring-green-500 focus:outline-none"
                            >
                        </div>
                        {{-- รายละเอียด --}}
                        <div class="md:col-span-4">
                            <label class="block mb-2 text-sm font-medium">
                                รายละเอียด :
                            </label>
                            <textarea
                                name="detail"
                                x-model="current.detail"
                                placeholder="กรอกรายละเอียด"
                                rows="3"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                    bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                    focus:ring-2 focus:ring-green-500 focus:outline-none"
                            ></textarea>
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
