<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('บันทึกข้อมูลการตรวจเช็คสภาพเครื่องปั่นไฟ') }}
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

                    <form method="POST" action="{{ route('check_sheet.store') }}">
                        @csrf

                        {{-- ELECTRICAL NO --}}
                        <div class="mb-3">
                            <label>ELECTRICAL NO.</label>
                            <input type="text" name="electrical_number"
                                class="form-control bg-gray-50 dark:bg-gray-800"
                                value="ELECT-00005">
                        </div>

                        {{-- วันที่ตรวจ --}}
                        <div class="mb-3">
                            <label>วันที่ตรวจ</label>
                            <input type="date" name="check_date" class="form-control scheme-dark bg-gray-50 dark:bg-gray-800">
                        </div>

                        {{-- เวลาที่ตรวจ --}}
                        <div class="mb-3">
                            <label>เวลาที่ตรวจ</label>
                            <input type="time" name="check_time" class="form-control scheme-dark bg-gray-50 dark:bg-gray-800">
                        </div>

                        {{-- เครื่องปั่นไฟ --}}
                        <div class="mb-3">
                            <label>เครื่องปั่นไฟ</label>
                            <select name="generator_name" class="form-control col-start-1 row-start-1 appearance-none bg-gray-50 dark:bg-gray-800">
                                <option value="">-- เลือก --</option>
                                <option value="Generator A">Generator A</option>
                                <option value="Generator B">Generator B</option>
                            </select>
                        </div>

                        {{-- ผู้บันทึก --}}
                        <div class="mb-3">
                            <label>ผู้บันทึก</label>
                            <input type="text" name="created_by"
                                class="form-control  bg-gray-50 dark:bg-gray-800"
                                value="{{ auth()->user()->name ?? '' }}">
                        </div>

                        {{-- หมายเหตุ --}}
                        <div class="mb-3">
                            <label>หมายเหตุ</label>
                            <textarea name="remark" class="form-control  bg-gray-50 dark:bg-gray-800"></textarea>
                        </div>

                        <button class="btn btn-success">
                            บันทึกข้อมูล
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
