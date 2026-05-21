<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="flex items-start gap-2 font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight sm:items-center sm:text-xl">
                <a id="backBtn"
                    onclick="history.back()"
                    class="shrink-0 cursor-pointer">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
                {{ __('รายละเอียดใบตรวจเช็คเครื่องปั่นไฟ') }}
            </h2>
            <a href="{{ route('inspection.pdf', $inspection) }}" target="_blank"
                class="btn btn-primary w-full text-center text-gray-800 dark:text-gray-200 leading-tight sm:w-auto">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
        </div>
    </x-slot>
    <div class="py-4 sm:py-6">
        <div class="mx-auto max-w-full">
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 dark:bg-gray-900 dark:ring-gray-800">
                <div class="p-4 text-gray-900 dark:text-gray-100 sm:p-6">
                    <div class="space-y-4 text-sm sm:text-base">
                        <div class="flex flex-col gap-2 sm:flex-row sm:justify-between">
                            <div><b>เลขที่ใบตรวจ:</b> <b>{{ $inspection->inspection_no }}</b></div>
                            <div><b>วันที่:</b> {{ \Carbon\Carbon::parse($inspection->inspection_date.' '.$inspection->inspection_time)->format('d/m/Y H:i') }} น.<br>
                            </div>
                        </div>
                        <div><b>เครื่องปั่นไฟ:</b> {{ $inspection->generator->machine_code }} | {{ $inspection->generator->asset_name }} </div>
                        <div><b>ผู้บันทึก:</b> {{ $inspection->user->name }}</div>
                        <div><b>หมายเหตุ:</b> {{ $inspection->remark ?? '-' }}</div>

                        <div class="mt-5 overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
                            <table class="w-full min-w-[640px] table-auto text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-3 py-3 text-left text-sm font-semibold sm:px-4 sm:text-base">ลำดับ</th>
                                    <th class="px-3 py-3 text-left text-sm font-semibold sm:px-4 sm:text-base">รายการตรวจ</th>
                                    <th class="px-3 py-3 text-sm font-semibold sm:px-4 sm:text-base">สถานะ</th>
                                    <th class="px-3 py-3 text-left text-sm font-semibold sm:px-4 sm:text-base">หมายเหตุ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                                @foreach ($inspection->checklistResults as $i)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-3 py-3 sm:px-4">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-3 sm:px-4">{{ $i->checklist->checklist_name }}</td>
                                    <td class="px-3 py-3 text-center sm:px-4">
                                        @switch($i->status)
                                        @case(1) ผ่าน @break
                                        @case(2) ไม่ผ่าน @break
                                        @default ไม่ได้ตรวจ
                                        @endswitch
                                    </td>
                                    <td class="px-3 py-3 sm:px-4">{{ $i->remark ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backBtn = document.getElementById('backBtn');
            if (window.history.length <= 1) {
                backBtn.style.display = 'none';
            }
        });
    </script>
</x-app-layout>
