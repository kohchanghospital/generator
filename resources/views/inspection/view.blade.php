<x-app-layout>
    <x-slot name="header">
        <div class="flex sticky justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <!-- <a href="{{ route('inspection.index') }}"> <i class="bi bi-arrow-left-circle"></i></a> -->
                {{ __('รายละเอียดใบตรวจเช็คเครื่องปั่นไฟ') }}
            </h2>
            <a href="{{ route('inspection.pdf', $inspection) }}" target="_blank"
                class="absolute top-0 right-0 btn btn-primary text-gray-800 dark:text-gray-200 leading-tight">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6 space-y-4 text-base">
                        <div class="flex sticky justify-between">
                            <div><b>เลขที่ใบตรวจ:</b> <b>{{ $inspection->inspection_no }}</b></div>
                            <div><b>วันที่:</b> {{ \Carbon\Carbon::parse($inspection->inspection_date.' '.$inspection->inspection_time)->format('d/m/Y H:i') }} น.<br>
                            </div>
                        </div>
                        <div><b>เครื่องปั่นไฟ:</b> {{ $inspection->generator->machine_code }} | {{ $inspection->generator->asset_name }} </div>
                        <div><b>ผู้บันทึก:</b> {{ $inspection->user->name }}</div>
                        <div><b>หมายเหตุ:</b> {{ $inspection->remark ?? '-' }}</div>

                        <table class="w-full border mt-6 border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-base font-semibold">ลำดับ</th>
                                    <th class="px-4 py-3 text-left text-base font-semibold">รายการตรวจ</th>
                                    <th class="px-4 py-3 text-base font-semibold">สถานะ</th>
                                    <th class="px-4 py-3 text-left text-base font-semibold">หมายเหตุ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                                @foreach ($inspection->checklistResults as $i)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3">{{ $i->checklist->checklist_name }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @switch($i->status)
                                        @case(1) ผ่าน @break
                                        @case(2) ไม่ผ่าน @break
                                        @default ไม่ได้ตรวจ
                                        @endswitch
                                    </td>
                                    <td class="px-4 py-3">{{ $i->remark ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>