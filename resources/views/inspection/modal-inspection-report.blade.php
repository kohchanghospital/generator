<div
    x-data="{
        openReport: false,
        typeReport: @js($typeReport ?? 'inspection'),
        reportMode: '10',
        customLimit: ''
    }"
    @open-inspection-report.window="openReport = true">

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
            class="fixed inset-0 z-50 flex items-end justify-center overflow-y-auto p-3 sm:items-center sm:p-6"
            @click.stop>
            <div class="w-full max-w-md rounded-2xl bg-white p-4 text-gray-900 shadow-xl dark:bg-gray-800 dark:text-gray-100 sm:p-6">
                <div class="mb-4 flex items-start justify-between gap-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        สร้างรายงาน
                    </h2>
                    <button type="button" @click="openReport = false" class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-gray-500 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-950/40">
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

                    <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                        <button type="button"
                            @click="openReport = false"
                            class="w-full px-4 py-2 rounded-lg 
                                bg-gray-300 hover:bg-gray-400
                                dark:bg-gray-600 dark:hover:bg-gray-500
                                text-gray-900 dark:text-white sm:w-auto">
                            ยกเลิก
                        </button>

                        <button
                            class="w-full rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 sm:w-auto"
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
