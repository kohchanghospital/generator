<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('รายละเอียดการตรวจ') }}
            </h2>
            <a href="#" class="btn btn-primary text-gray-800 dark:text-gray-200 leading-tight">
                ⬇️ Generate Report
            </a>
        </div>
    </x-slot>
    <h3>รายละเอียดการตรวจ</h3>

    <p>Electrical Number: {{ $item->electrical_number }}</p>
    <p>วันที่ตรวจ: {{ $item->check_date }}</p>
    <p>เวลา: {{ $item->check_time }}</p>
    <p>ผู้บันทึก: {{ $item->created_by }}</p>
    <p>หมายเหตุ: {{ $item->remark }}</p>
</x-app-layout>
