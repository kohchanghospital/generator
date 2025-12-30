<x-app-layout>
    <x-slot name="header">
        <div class="flex sticky justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('รายการตรวจเช็คเครื่องปั่นไฟที่ไม่ผ่าน / ไม่ได้ตรวจ') }}
            </h2>
            <a href="#" class="absolute top-0 right-0 btn btn-primary text-gray-800 dark:text-gray-200 leading-tight">
                <i class="bi bi-file-earmark-arrow-down"></i> Generate Report
            </a>
        </div>
    </x-slot>
    <div x-data="{
        open: false,
        mode: 'deit',
        current: {},

        async editInspection(id) {
            const res = await fetch('{{ url('inspection') }}/' + id, {
                headers: { 'Accept': 'application/json' }
            });

            const data = await res.json();

            // map checklistResults -> object สำหรับ form
            const checklistMap = {};
            data.checklist_results.forEach(row => {
                checklistMap[row.checklist_id] = {
                    status: row.status,
                    remark: row.remark
                };
            });

            this.current = {
                id: data.id,
                inspection_no: data.inspection_no,
                inspection_date: data.inspection_date,
                inspection_time: data.inspection_time,
                generator_id: data.generator_id,
                remark: data.remark,
                checklist: checklistMap
            };

            this.mode = 'edit';
            this.open = true;
        },

    }">
        <div class="py-6">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="overflow-x-auto">
                            <table class="min-w-full border table-auto border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">ลำดับ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">เลขที่ใบตรวจ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">วัน/เวลา</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">เครื่อง</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">ผู้ตรวจ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">หมายเหตุ</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($lists as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-4 py-3"> {{ $lists->firstItem() + $loop->index }} </td>
                                        <td class="px-4 py-3"> {{ $item->inspection_no }} </td>
                                        <td class="px-4 py-3"> {{ \Carbon\Carbon::parse($item->inspection_date)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($item->inspection_time)->format('H:i') }}</td>
                                        <td class="px-4 py-3"> {{ $item->generator->machine_code }} | {{ $item->generator->asset_name }} </td>
                                        <td class="px-4 py-3"> {{ $item->user->name }} </td>
                                        <td class="px-4 py-3 text-gray-500">{{ $item->remark ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <div class="relative group">
                                                    <a href="{{ route('inspection.view', $item->id) }}"
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                                            bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                                                        🔍
                                                    </a>
                                                    <span
                                                        class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap rounded bg-gray-800 px-2 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition">
                                                        ดูรายละเอียด
                                                    </span>
                                                </div>
                                                <div class="relative group">
                                                    <button
                                                        @click="editInspection({{ $item->id }})"
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                                            bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition">
                                                        ✏️
                                                    </button>
                                                    <span
                                                        class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap rounded bg-gray-800 px-2 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition">
                                                        แก้ไข
                                                    </span>
                                                </div>
                                                <div class="relative group">
                                                    <a href="{{ route('inspection.pdf', $item->id) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                                            bg-orange-200 text-orange-900 hover:bg-orange-300 transition">
                                                        <i class="bi bi-file-pdf"></i>
                                                    </a>
                                                    <span
                                                        class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap rounded bg-gray-800 px-2 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition">
                                                        pdf
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-6 text-gray-500">
                                            ✅ ไม่มีรายการผิดปกติ
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-gray-100 dark:bg-gray-700 border-t border-gray-300 dark:border-gray-600">
                                    <tr>
                                        <td colspan="7" class="px-3 py-2 text-right text-sm font-semibold">
                                            <x-pagination :lists="$lists" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('inspection.modal')
    </div>
    <x-toast-validation />
    <x-toast />
</x-app-layout>