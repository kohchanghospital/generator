<div>

    <!-- Modal -->
    <div
        x-show="openReport"
        x-transition
        x-cloak
        class="fixed inset-0 bg-black/30 backdrop-blur-[4px] z-40"
        @click="openReport = false">
        <div
            class="absolute inset-0 bg-black/40"
            @click="openReport=false">
        </div>

        <div
            x-show="openReport"
            x-transition
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center "
            @click.stop>
            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 w-full max-w-md rounded-lg p-6 shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        สร้างรายงาน
                    </h2>
                    <button @click="openReport = false" class="text-xl text-gray-500 hover:text-red-500">
                        ✕
                    </button>
                </div>

                <form method="GET"
                    :action="typeReport === 'exception' ? '{{ route('inspection.report.exception') }}' : '{{ route('inspection.report.inspection') }}'"
                    target="_blank"
                    @submit.prevent="
                    if (reportMode === 'custom' && !customLimit) {
                        alert('กรุณาระบุจำนวนรายการ');
                        return;
                    }
                    $el.submit();">

                    <div class="space-y-3">
                        <div class="font-medium">
                            จำนวนรายการที่ต้องการในรายงาน:
                        </div>

                        <!-- Dropdown -->
                        <select
                            x-model="reportMode"
                            name="limit"
                            class="w-full rounded-lg border
                                bg-white dark:bg-gray-700
                                text-gray-900 dark:text-gray-100
                                border-gray-300 dark:border-gray-600 px-3 py-2">
                            <option value="10">10 รายการ</option>
                            <option value="20">20 รายการ</option>
                            <option value="50">50 รายการ</option>
                            <option value="100">100 รายการ</option>
                            <option value="all">ทั้งหมด</option>
                            <option value="custom">กำหนดเอง</option>
                        </select>

                        <!-- Custom input -->
                        <input
                            x-show="reportMode === 'custom'"
                            x-transition
                            x-model="customLimit"
                            type="number"
                            min="1"
                            name="custom_limit"
                            placeholder="กรอกจำนวนรายการ"
                            class="w-full rounded-lg border
                                bg-white dark:bg-gray-700
                                text-gray-900 dark:text-gray-100
                                border-gray-300 dark:border-gray-600 px-3 py-2">
                    </div>

                    <div class=" flex justify-end gap-2 mt-6">
                        <button type="button"
                            @click="openReport = false"
                            class="px-4 py-2 rounded-lg 
                                bg-gray-300 hover:bg-gray-400
                                dark:bg-gray-600 dark:hover:bg-gray-500
                                text-gray-900 dark:text-white">
                            ยกเลิก
                        </button>

                        <button
                            class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white"
                            @click="openReport = false">
                            สร้างรายงาน
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