<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('บันทึกข้อมูลเครื่องปั่นไฟ') }}
        </h2>
    </x-slot>
    <div x-data="{
            open: false,
            mode: 'create', // create | edit
            current: {
                id: null,
                is_active: 1
            },
            confirmDelete: false,
            baseUrl: '{{ url('generator') }}',
            deleteId: null,
            deleteName: '',
        }">
        <div class="py-4 sm:py-6">
            <div class="mx-auto max-w-full">
                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 dark:bg-gray-900 dark:ring-gray-800">
                    <div class="p-4 text-gray-900 dark:text-gray-100 sm:p-6">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                            <button @click="
                                mode = 'create';
                                current = { id: null, is_active: 1 };
                                open = true;
                            " class="btn btn-success w-full sm:w-auto">
                                <b><i class="bi bi-plus-circle"></i></b> เพิ่มข้อมูล
                            </button>
                            <x-per-page />
                        </div>
                        <div class="mt-5 overflow-x-auto rounded-xl border border-slate-200 dark:border-gray-700">
                            <table class="w-full min-w-[820px] table-auto overflow-hidden text-sm">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">ลำดับ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">หมายเลยครุภัณฑ์</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">ชื่อครุภัณฑ์</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">ยี่ห้อ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">รายละเอียด</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold">สถานะ</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($lists as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3">
                                            <div class="max-w-[50px] sm:max-w-[80px] md:max-w-[100px] truncate" title="{{ $item->asset_no }}">
                                                {{ $item->asset_no ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="max-w-[50px] sm:max-w-[80px] md:max-w-[100px] truncate" title="{{ $item->asset_name }}">
                                                {{ $item->asset_name ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="max-w-[50px] sm:max-w-[80px] md:max-w-[100px] truncate" title="{{ $item->brand }}">
                                                {{ $item->brand ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="block truncate max-w-[80px] sm:max-w-[120px] md:max-w-[150px]" title="{{ $item->detail }}">
                                                {{ $item->detail ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @if ($item->is_active == 1)
                                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                                                    bg-green-100 text-green-700 text-sm font-medium">
                                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                                เปิดใช้งาน
                                            </span>
                                            @else
                                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                                                    bg-red-100 text-red-700 text-sm font-medium">
                                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                                ปิดใช้งาน
                                            </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <div class="relative group">
                                                    <button @click="
                                                            mode = 'view';
                                                            current = {
                                                                id: {{ $item->id }},
                                                                machine_code: '{{ $item->machine_code }}',
                                                                asset_no: '{{ $item->asset_no }}',
                                                                asset_name: '{{ $item->asset_name }}',
                                                                brand: '{{ $item->brand }}',
                                                                detail: '{{ $item->detail }}',
                                                                is_active: {{ $item->is_active }}
                                                            };
                                                            open = true;
                                                        " class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                                            bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                                                        🔍
                                                    </button>
                                                    <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap rounded bg-gray-800 px-2 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition">
                                                        ดูรายละเอียด
                                                    </span>
                                                </div>
                                                <div class="relative group">
                                                    <button @click="
                                                            mode = 'edit';
                                                            current = {
                                                                id: {{ $item->id }},
                                                                machine_code: '{{ $item->machine_code }}',
                                                                asset_no: '{{ $item->asset_no }}',
                                                                asset_name: '{{ $item->asset_name }}',
                                                                brand: '{{ $item->brand }}',
                                                                detail: '{{ $item->detail }}',
                                                                is_active: {{ $item->is_active }}
                                                            };
                                                            open = true;
                                                        " class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                                            bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition">
                                                        ✏️
                                                    </button>
                                                    <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap rounded bg-gray-800 px-2 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition">
                                                        แก้ไข
                                                    </span>
                                                </div>
                                                <div class="relative group">
                                                    @if ($item->inspections_count > 0)
                                                    <button disabled class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                                                        bg-gray-300 text-gray-500 cursor-not-allowed">
                                                        <b>X</b>
                                                    </button>
                                                    <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap rounded bg-gray-800 px-2 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition">
                                                        ไม่สามารถลบได้ เนื่องจากถูกใช้งานในใบตรวจสอบ
                                                    </span>
                                                    @else
                                                    <button @click="
                                                        deleteId = {{ $item->id }};
                                                        deleteName = '{{ $item->asset_name }}';
                                                        confirmDelete = true;" class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                                        bg-red-500 text-white hover:bg-red-600 transition">
                                                        <b>X</b>
                                                    </button>
                                                    <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap rounded bg-gray-800 px-2 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition">
                                                        ลบ
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                            🚫 ไม่มีข้อมูลให้แสดง
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                @if($lists->count())
                                <tfoot class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <td colspan="7" class="px-3 py-2 text-right text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            <x-pagination :lists="$lists" />
                                        </td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                        <x-modal-delete />
                    </div>
                </div>
            </div>
        </div>
        @include('generator.modal')
    </div>
    <x-toast-validation />
    <x-toast />
</x-app-layout>
