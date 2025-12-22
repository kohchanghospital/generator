<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('บันทึกข้อมูลเครื่องปั่นไฟ') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('generator.create') }}" class="btn btn-success">
                        <b><i class="bi bi-plus-circle"></i></b> เพิ่มข้อมูล
                    </a>
                    <div class="overflow-x-auto pt-6">
                        <table class="min-w-full border table-auto border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">ลำดับ</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">รหัสเครื่อง</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">หมายเลยครุภัณฑ์</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">ชื่อครุภัณฑ์</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">ยี่ห้อ</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">รายละเอียด</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($lists as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3">{{ $item->machine_code }}</td>
                                    <td class="px-4 py-3">{{ $item->asset_no }}</td>
                                    <td class="px-4 py-3">{{ $item->asset_name }}</td>
                                    <td class="px-4 py-3">{{ $item->brand }}</td>
                                    <td class="px-4 py-3">{{ $item->detail ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <div class="relative group">
                                                <a href="{{ route('generator.show', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                                                    🔍
                                                </a>
                                                <span
                                                    class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap rounded bg-gray-800 px-2 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition">
                                                    ดูรายละเอียด
                                                </span>
                                            </div>
                                            <div class="relative group">
                                                <a href="{{ route('generator.edit', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition">
                                                    ✏️
                                                </a>
                                                <span
                                                    class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap rounded bg-gray-800 px-2 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition">
                                                    แก้ไข
                                                </span>
                                            </div>
                                            <div class="relative group">
                                                <form method="POST" action="{{ route('generator.destroy', $item->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('ยืนยันการลบ?')" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-500 text-white hover:bg-red-600 transition">
                                                        <b>X</b>
                                                    </button>
                                                </form>
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
                                    <td colspan="6"
                                        class="px-4 py-3 text-right text-sm font-semibold text-gray-700 dark:text-gray-200">
                                        จำนวนรายการทั้งหมด
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm font-bold text-gray-900 dark:text-white">
                                        {{ $lists->count() }} รายการ
                                    </td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>