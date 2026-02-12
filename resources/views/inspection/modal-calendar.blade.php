<div>
    <div
        x-show="open"
        x-transition
        x-cloak
        class="fixed inset-0 bg-black/30 backdrop-blur-[4px] z-40"
        @click="open = false">
        <!-- Backdrop -->
        <div
            class="absolute inset-0 bg-black/40"
            @click="open = false">
        </div>

        <!-- Modal -->
        <div
            x-show="open"
            x-transition
            class="fixed inset-0 z-50 flex items-center justify-center "
            @click.stop>
            <div class="bg-white dark:bg-gray-800 w-full max-w-md rounded-lg p-6 shadow-lg">
                <!-- Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        Export Report
                    </h2>
                    <button @click="open = false" class="text-xl text-gray-500 hover:text-red-500">
                        ✕
                    </button>
                </div>

                <!-- Body -->
                <form method="GET" action="{{ route('inspection.calendar.pdf') }}">
                    <input type="hidden" name="month" id="selectedMonth">
                    <input type="hidden" name="year" id="selectedYear">

                    <div class="mb-4 text-gray-800 dark:text-gray-200">
                        <label class="font-semibold">เลือกช่วงเวลา</label>

                        <div class="mt-2 space-y-2">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="mode" value="current" checked>
                                เดือนนี้
                            </label>

                            <label class="flex items-center gap-2">
                                <input type="radio" name="mode" value="custom">
                                เลือกเดือน / ปี
                            </label>
                        </div>
                    </div>

                    <!-- Custom picker -->
                    <div id="monthPicker" style="display:none">
                        <div class="mb-2 text-gray-800 dark:text-gray-200">
                            <label>เดือน : </label>
                            <select
                                name="month"
                                class="w-xs rounded-lg border
                            bg-white dark:bg-gray-700
                            text-gray-900 dark:text-gray-100
                            border-gray-300 dark:border-gray-600">
                                @foreach(range(1,12) as $m)
                                <option value="{{ $m }}">
                                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4 text-gray-800 dark:text-gray-200">
                            <label>ปี : </label>
                            <select
                                name="year"
                                class="w-xsS rounded-lg border
                            bg-white dark:bg-gray-700
                            text-gray-900 dark:text-gray-100
                            border-gray-300 dark:border-gray-600">
                                @foreach(range(now()->year - 2, now()->year + 2) as $y)
                                <option value="{{ $y }}" {{ $y == now()->year ? 'selected' : '' }}>
                                    {{ $y + 543 }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end gap-2">
                        <button
                            type="button"
                            @click="open = false"
                            class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400
                        dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-900 dark:text-white">
                            ยกเลิก
                        </button>
                        <button
                            type="submit"
                            formaction="{{ route('inspection.calendar.pdf') }}"
                            formtarget="_blank"
                            class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white">
                            Export PDF
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