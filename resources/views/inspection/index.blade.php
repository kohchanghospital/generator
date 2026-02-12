<x-app-layout>
    <x-slot name="header">
        <div class="flex sticky justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('รายละเอียดตรวจเช็คเครื่องปั่นไฟ') }}
            </h2>
        </div>
    </x-slot>
    <div x-data="{
            open: false,
            openReport: false,
            typeReport: 'inspection',
            reportMode: '10',
            customLimit: '',
            mode: 'create', // create | edit
            current: {
                id: null,
                inspection_no: ''
            },
            async previewInspectionNo() {
                const res = await fetch('{{ route('inspection.preview-no') }}');
                const data = await res.json();
                this.current.inspection_no = data.inspection_no;
            },
            async loadInspection(id) {
                const url = '{{ route('inspection.show', ':id') }}'.replace(':id', id);

                const res = await fetch(url, {
                    headers: { 'Accept': 'application/json' }
                });

                const data = await res.json();

                // แปลง checklist_results เป็น object
                const checklistMap = {};
                data.checklist_results.forEach(item => {
                    checklistMap[item.checklist_id] = {
                        status: item.status,
                        remark: item.remark
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

                this.mode = 'view';
                this.open = true;
            },
            statusText(status) {
                return {
                    1: 'ผ่าน',
                    2: 'ไม่ผ่าน',
                    3: 'ไม่ได้ตรวจ'
                }[status] ?? '-';
            },

            confirmDelete: false,
            baseUrl: '{{ url('inspection') }}',
            deleteId: null,
            deleteName: '',
        }">
        <div class="grid justify-items-end">
            <button
                @click="openReport = true"
                class="btn btn-primary text-gray-800 dark:text-gray-200 leading-tight">
                <i class="bi bi-file-earmark-arrow-down"></i> Export Report
            </button>
        </div>
        <div class="py-6">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex sticky justify-between items-end">
                            <button
                                @click="
                                    mode = 'create';
                                    current = { id: null, inspection_no: '' };
                                    previewInspectionNo();
                                    open = true;"
                                class="btn btn-success">
                                <b><i class="bi bi-plus-circle"></i></b> เพิ่มข้อมูล
                            </button>
                            <x-per-page />
                        </div>
                        <div class="overflow-x-auto pt-6">
                            <table class="min-w-full border table-auto border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">ลำดับ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">เลขที่ใบตรวจ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">วันที่ตรวจ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">เวลาที่ตรวจ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">ผู้บันทึก</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">หมายเหตุ</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($lists as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-4 py-3">{{ $lists->firstItem() + $loop->index }}</td>
                                        <td class="px-4 py-3">{{ $item->inspection_no }}</td>
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->inspection_date)->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->inspection_time)->format('H:i')}}</td>
                                        <td class="px-4 py-3">{{ $item->user->name }}</td>
                                        <td class="px-4 py-3 text-gray-500">{{ $item->remark ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <div class="relative group">
                                                    <span
                                                        class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap rounded bg-gray-800 px-2 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition">
                                                        ดูรายละเอียด
                                                    </span>
                                                    <a href="{{ route('inspection.view', $item->id) }}"
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                                            bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                                                        🔍
                                                    </a>
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
                                                <div class="relative group">
                                                    <button @click="deleteId = {{ $item->id }}; deleteName = '{{ $item->inspection_no }}'; confirmDelete = true; "
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-500 text-white hover:bg-red-600 transition">
                                                        <b>X</b>
                                                    </button>
                                                    <span
                                                        class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap rounded bg-gray-800 px-2 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition">
                                                        ลบ
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8"
                                            class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                            🚫 ไม่มีข้อมูลให้แสดง
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
                        <x-modal-delete />
                    </div>
                </div>
            </div>
            @include('inspection.modal')
            @include('inspection.modal-inspection-report')
        </div>
    </div>
    <x-toast-validation />
    <x-toast />
</x-app-layout>