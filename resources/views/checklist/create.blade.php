<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('บันทึกข้อมูลการตรวจเช็คใหม่') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-2 mb-3">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('checklist.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6 items-end">

                            {{-- รายการตรวจเช็ค --}}
                            <div class="md:col-span-3">
                                <label class="block mb-2 text-sm font-medium">รายการตรวจเช็ค : </label>
                                <input type="text" name="checklist_name"
                                    class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800
                                    px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                                    placeholder="กรอกรายการตรวจเช็ค" required value="">
                            </div>
                            <div class="">
                                <label class="block mb-2 text-sm font-medium">สถานะ : </label>
                                <div class="flex items-center gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input checked
                                            type="radio"
                                            name="is_active"
                                            value="1"
                                            class="text-green-600 focus:ring-green-500">
                                        <span>เปิดใช้งาน</span>
                                    </label>

                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input
                                            type="radio"
                                            name="is_active"
                                            value="0"
                                            class="text-red-600 focus:ring-red-500">
                                        <span>ปิดใช้งาน</span>
                                    </label>
                                </div>
                            </div>


                        </div>
                        {{-- BUTTON --}}
                        <div class="flex justify-end mt-6">
                            <button
                                class="inline-flex items-center px-6 py-2
                                    bg-green-600 hover:bg-green-700
                                    text-white font-semibold rounded-lg transition">
                                บันทึกข้อมูล
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>