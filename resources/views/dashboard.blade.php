<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- SUMMARY CARDS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">

                {{-- เดือนนี้ --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
                    <p class="text-sm text-gray-500 dark:text-gray-400">ตรวจเดือนนี้</p>
                    <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">
                        {{ $monthCount ?? 0 }}
                    </p>
                </div>

                {{-- รายการตรวจทั้งหมด --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
                    <p class="text-sm text-gray-500 dark:text-gray-400">รายการตรวจทั้งหมด</p>
                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                        {{ $allCount ?? 0 }}
                    </p>
                </div>

                {{-- ผ่าน --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
                    <p class="text-sm text-gray-500 dark:text-gray-400">ผ่าน</p>
                    <p class="text-3xl font-bold text-green-600">
                        {{ $passCount ?? 0 }}
                    </p>
                </div>

                {{-- ไม่ผ่าน --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
                    <p class="text-sm text-gray-500 dark:text-gray-400">ไม่ผ่าน</p>
                    <p class="text-3xl font-bold text-red-600">
                        {{ $failCount ?? 0 }}
                    </p>
                </div>

                {{-- ไม่ได้ตรวจ --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
                    <p class="text-sm text-gray-500 dark:text-gray-400">ไม่ได้ตรวจสอบ</p>
                    <p class="text-3xl font-bold text-yellow-600">
                        {{ $notCheckedCount ?? 0 }}
                    </p>
                </div>
            </div>

            {{-- MAIN CONTENT --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ล่าสุด --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow">
                    <div class="p-5 border-b dark:border-gray-700">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200">
                            การตรวจล่าสุด
                        </h3>
                    </div>

                    <div class="divide-y dark:divide-gray-700">
                        @forelse($latestInspections ?? [] as $item)
                        <div class="p-5 flex justify-between items-center">
                            <div>
                                <p class="font-medium">
                                    {{ $item->inspection_no }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $item->inspection_date }}
                                </p>
                            </div>

                            <span class="px-3 py-1 rounded-full text-sm
                                    {{ $item->status === 'pass'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">
                                {{ strtoupper($item->status) }}
                            </span>
                        </div>
                        @empty
                        <div class="p-5 text-gray-500">
                            ไม่มีข้อมูล
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- QUICK ACTION --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 space-y-4">
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">
                        เมนูลัด
                    </h3>

                    <a href="{{ route('inspection.index') }}"
                        class="block w-full text-center px-4 py-2 rounded-lg
                            bg-indigo-600 text-white hover:bg-indigo-700">
                        ➕ บันทึกการตรวจใหม่
                    </a>

                    <a href="{{ route('inspection.calendar') }}"
                        class="block w-full text-center px-4 py-2 rounded-lg
                            bg-slate-200 dark:bg-slate-700
                            text-gray-800 dark:text-gray-200">
                        📅 ดูปฏิทิน
                    </a>
                </div>
                {{-- MINI CALENDAR --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200">
                            ปฏิทินการตรวจ
                        </h3>
                        <a href="{{ route('inspection.calendar') }}"
                            class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            ดูทั้งหมด
                        </a>
                    </div>
                    <div id="mini-calendar"></div>
                </div>

            </div>
        </div>
    </div>
    {{-- FullCalendar CDN --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const miniEl = document.getElementById('mini-calendar');
            if (!miniEl) return;

            const miniCalendar = new FullCalendar.Calendar(miniEl, {
                initialView: 'dayGridMonth',
                locale: 'th',
                height: 'auto',

                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                },

                events: '{{ route("inspection.calendar.events") }}',

                eventClick(info) {
                    info.jsEvent.preventDefault();
                    window.location.href = '{{ route("inspection.calendar") }}';
                }
            });

            miniCalendar.render();
        });
    </script>

</x-app-layout>
<style>
    #mini-calendar {
        font-size: 12px;
    }

    #mini-calendar .fc-toolbar {
        padding: 4px;
        margin-bottom: 6px;
    }

    #mini-calendar .fc-toolbar-title {
        font-size: 14px;
        font-weight: 600;
    }

    #mini-calendar .fc-button {
        padding: 2px 6px;
        font-size: 12px;
    }

    #mini-calendar .fc-daygrid-day-number {
        font-size: 11px;
    }
</style>