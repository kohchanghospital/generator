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
            x-cloak
            class="fixed inset-0 z-50 flex items-end justify-center overflow-y-auto p-3 sm:items-center sm:p-6"
            @click.stop>
            <div class="w-full max-w-md rounded-2xl bg-white p-4 shadow-xl dark:bg-gray-800 sm:p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        Export Report
                    </h2>
                    <button type="button" @click="open = false" class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-gray-500 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-950/40">
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

                            <div id="monthPicker" style="display:none">
                                <div class="mb-2 text-gray-800 dark:text-gray-200">
                                    <label>เดือน : </label>
                                    <select
                                        name="month"
                                            class="w-full rounded-lg border
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
                                        class="w-full rounded-lg border
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

                            <!-- <label class="flex items-center gap-2 disabled">
                                <input type="radio" name="mode" value="range">
                                เลือกช่วงเดือน
                            </label>
                            <div id="rangePicker" style="display:none">
                                <div class="mb-2">
                                    <label>จากเดือน :</label>
                                    <input type="month" name="start_month"
                                        class="w-full rounded-lg border">
                                </div>
                                <div class="mb-4">
                                    <label>ถึงเดือน :</label>
                                    <input type="month" name="end_month"
                                        class="w-full rounded-lg border">
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            @click="open = false"
                            class="w-full rounded-lg bg-gray-300 px-4 py-2 text-gray-900 hover:bg-gray-400 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500 sm:w-auto">
                            ยกเลิก
                        </button>
                        <button
                            type="submit"
                            formaction="{{ route('inspection.calendar.pdf') }}"
                            formtarget="_blank"
                            @click="open = false"
                            class="w-full rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 sm:w-auto">
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
