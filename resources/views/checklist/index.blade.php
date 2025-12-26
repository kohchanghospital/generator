<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ตั้งค่ารายการตรวจเช็ค') }}
        </h2>
    </x-slot>
    <div x-data="{
            open: false,
            mode: 'create', // create | edit
            current: {
                id: null,
                checklist_name: '',
                status: 1
            },
            confirmDelete: false,
            baseUrl: '{{ url('checklist') }}',
            deleteId: null,
            deleteName: '',
        }">
        <div class="py-6">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex sticky justify-between items-end">
                            <button
                                @click="
                                    mode = 'create';
                                    current = { id: null, checklist_name: '', status: 1 };
                                    open = true;"
                                class="btn btn-success">
                                <b><i class="bi bi-plus-circle"></i></b> เพิ่มรายการ
                            </button>
                            <x-per-page />
                        </div>
                        <div class="overflow-x-auto pt-6">
                            <table class="min-w-full table-auto border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">ลำดับ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">รายการตรวจสอบ</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold">สถานะ</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($lists as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-4 py-3">{{ $lists->firstItem() + $loop->index }}</td>
                                        <td class="px-4 py-3">{{ $item->checklist_name }}</td>
                                        <td class="px-4 py-3 text-center">
                                            @if ($item->status == 1)
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
                                                    <button
                                                        @click="
                                                            mode = 'edit';
                                                            current = {
                                                                id: {{ $item->id }},
                                                                checklist_name: '{{ $item->checklist_name }}',
                                                                status: {{ $item->status }}
                                                            };
                                                            open = true;
                                                        "
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
                                                    <button @click=" deleteId = {{ $item->id }}; deleteName = '{{ $item->checklist_name }}'; confirmDelete = true; "
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
                                @if($lists->count())
                                <tfoot class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <td colspan="4" class="px-3 py-2 text-right text-sm font-semibold">
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
        @include('checklist.modal')
    </div>
    <x-toast-validation />
    <x-toast />
</x-app-layout>