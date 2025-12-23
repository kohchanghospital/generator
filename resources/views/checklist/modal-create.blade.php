<x-modal name="create-checklist" focusable>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg ">

        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                บันทึกข้อมูลการตรวจเช็คใหม่
            </h2>
            <button
                x-on:click="$dispatch('close')"
                class="text-gray-500 hover:text-red-500 text-xl">
                ✕
            </button>
        </div>

        <!-- Body -->
        <div class="p-6 text-gray-900 dark:text-gray-100">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('checklist.store') }}">
                @csrf
                    {{-- รายการตรวจเช็ค --}}
                    <div class="">
                        <label class="block mb-2 text-sm font-medium">
                            รายการตรวจเช็ค : 
                        </label>
                        <input
                            type="text"
                            name="checklist_name"
                            required
                            placeholder="กรอกรายการตรวจเช็ค"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                bg-gray-50 dark:bg-gray-800 px-4 py-2
                                focus:ring-2 focus:ring-green-500 focus:outline-none">
                    </div>
                    {{-- สถานะ --}}
                    <div class="pt-5 pb-5">
                        <label class="block mb-2 text-sm font-medium">
                            สถานะ : 
                        </label>
                        <div class="flex items-center gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input
                                    type="radio"
                                    name="status"
                                    value="1"
                                    checked
                                    class="text-green-600 focus:ring-green-500">
                                <span>เปิดใช้งาน</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input
                                    type="radio"
                                    name="status"
                                    value="2"
                                    class="text-red-600 focus:ring-red-500">
                                <span>ปิดใช้งาน</span>
                            </label>
                        </div>
                    </div>
                <!-- Footer -->
                <div class="flex justify-end gap-3">
                    <button
                        type="button"
                        x-on:click="$dispatch('close')"
                        class="px-5 py-2 rounded-lg border border-gray-300 dark:border-gray-600">
                        ยกเลิก
                    </button>
                    <button
                        type="submit"
                        class="px-6 py-2 bg-green-600 hover:bg-green-700
                            text-white font-semibold rounded-lg">
                        บันทึกข้อมูล
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-modal>
