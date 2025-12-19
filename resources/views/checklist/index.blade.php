<x-app-layout>
    <x-slot name="header">
        <div class="flex sticky justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('รายละเอียดตรวจเช็คเครื่องปั่นไฟ') }}
            </h2>
            <a href="#" class="absolute top-0 right-0 btn btn-primary text-gray-800 dark:text-gray-200 leading-tight">
                ⬇️ Generate Report
            </a>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('checklist.create') }}" class="btn btn-success">
                        + เพิ่มข้อมูล
                    </a>
                    <div class="overflow-x-auto pt-6">
                        <table class="min-w-full border table-auto border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">ลำดับ</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Electrical Number</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">วันที่ตรวจ</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">เวลาที่ตรวจ</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">ผู้บันทึก</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">หมายเหตุ</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold">รายละเอียด</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold">ลบ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($lists as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $item->electrical_number }}</td>
                                    <td class="px-4 py-3">{{ $item->check_date }}</td>
                                    <td class="px-4 py-3">{{ $item->check_time }}</td>
                                    <td class="px-4 py-3">{{ $item->created_by }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $item->remark ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('checklist.show', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                                            🔍
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <form method="POST" action="{{ route('checklist.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('ยืนยันการลบ?')" class="inline-flex items-center px-3 py-1.5 text-sm bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                                                ลบ
                                            </button>
                                        </form>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>