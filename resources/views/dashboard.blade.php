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
                    <p class="text-3xl font-bold text-sky-600 dark:text-sky-400">
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
                    <p class="text-sm text-gray-500 dark:text-gray-400">✅ ผ่าน</p>
                    <p class="text-3xl font-bold text-green-600">
                        {{ $passCount ?? 0 }}
                    </p>
                </div>

                {{-- ไม่ผ่าน --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
                    <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                        ❌ ไม่ผ่าน

                        <span x-data="{ open:false }" class="relative">
                            <i class="bi bi-info-circle text-gray-400 cursor-pointer" @mouseenter="open=true" @mouseleave="open=false" @click="open = !open"></i>

                            <span x-show="open" x-transition class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2
                                    bg-gray-800 text-white text-xs
                                    rounded px-3 py-1 w-56 text-center shadow-lg z-50">
                                ไม่ผ่านและไม่ได้ตรวจ<br>
                                อาจอยู่ในใบตรวจเดียวกัน
                            </span>
                        </span>
                    </p>

                    <p class="text-3xl font-bold text-red-600">
                        {{ $failCount ?? 0 }}
                    </p>
                </div>

                {{-- ไม่ได้ตรวจ --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
                    <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                        ⏺ ไม่ได้ตรวจสอบ

                        <span x-data="{ open:false }" class="relative">
                            <i class="bi bi-info-circle text-gray-400 cursor-pointer" @mouseenter="open=true" @mouseleave="open=false" @click="open = !open"></i>

                            <span x-show="open" x-transition class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2
                                    bg-gray-800 text-white text-xs
                                    rounded px-3 py-1 w-56 text-center shadow-lg z-50">
                                ไม่ผ่านและไม่ได้ตรวจ<br>
                                อาจอยู่ในใบตรวจเดียวกัน
                            </span>
                        </span>
                    </p>

                    <p class="text-3xl font-bold text-yellow-600">
                        {{ $notCheckedCount ?? 0 }}
                    </p>
                </div>
            </div>

            {{-- MAIN CONTENT --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

                {{-- ล่าสุด --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow">
                    <div class="pt-5 ps-5 dark:border-gray-500">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200">
                            การตรวจล่าสุด
                        </h3>
                    </div>
                    <div class="p-5">
                        @if($latestInspection)
                        <div class="border rounded-lg p-4 bg-gray-50 dark:bg-gray-900">
                            @include('inspection._detail', [
                            'inspection' => $latestInspection
                            ])
                        </div>
                        @else
                        <p class="text-gray-500">ยังไม่มีข้อมูลการตรวจ</p>
                        @endif
                    </div>
                    @if($latestInspection)
                    <div class="pb-5 pe-5 flex justify-end items-center ">
                        <a href="{{ route('inspection.view', $latestInspection->id) }}" class="text-xs btn btn-primary">
                            🔍 ดูรายละเอียดเต็ม
                        </a>
                    </div>
                    @endif
                </div>

                {{-- QUICK ACTION --}}
                <div class="flex flex-col gap-6">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 space-y-4">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200">
                            เมนูลัด
                        </h3>

                        <a href="{{ route('inspection.index', ['open' => 'new']) }}"
                            class="block w-full text-center px-4 py-2 rounded-lg btn-success">
                            <i class="bi bi-plus-circle"></i> บันทึกการตรวจใหม่
                        </a>

                        <a href="{{ route('inspection.calendar') }}" class="block w-full text-center px-4 py-2 rounded-lg
                            bg-slate-200 dark:bg-slate-700
                            text-gray-800 dark:text-gray-200">
                            📅 ดูปฏิทิน
                        </a>
                    </div>
                    <a href="{{ route('dashboard.exportPdf') }}"
                        target="_blank"
                        class="btn btn-primary text-center text-gray-800 dark:text-gray-200 leading-tight">
                        <i class="bi bi-file-earmark-arrow-down"></i> Export Report
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>