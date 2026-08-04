<x-app-layout>
    <x-slot name="header">
        <div class="flex sticky justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('รายการตรวจเช็คเครื่องปั่นไฟที่ไม่ผ่าน / ไม่ได้ตรวจ') }}
            </h2>
        </div>
    </x-slot>
    <div x-data="{
        open: false,
        mode: 'edit',
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
        <div class="grid justify-items-end">
            <button
                type="button"
                @click="$dispatch('open-inspection-report')"
                class="btn btn-primary text-gray-800 dark:text-gray-200 leading-tight">
                <i class="bi bi-file-earmark-arrow-down"></i> Export Report
            </button>
        </div>
        <div class="py-4 sm:py-6">
            <div class="mx-auto max-w-full">
                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 dark:bg-gray-900 dark:ring-gray-800">
                    <div class="p-4 text-gray-900 dark:text-gray-100 sm:p-6">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                            <a></a>
                            <x-per-page />
                        </div>
                        <div class="mt-5 overflow-x-auto rounded-xl border border-slate-200 dark:border-gray-700">
                            <table class="w-full min-w-[760px] table-auto overflow-hidden text-sm">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">ลำดับ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">เลขที่ใบตรวจ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">วัน/เวลา</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">เครื่อง</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">ผู้ตรวจ</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">หมายเหตุ</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold relative">
                                            สถานะ
                                            <span x-data="{ open: false }" class="relative inline-block">
                                                <!-- ไอคอนตัว I -->
                                                <i class="bi bi-info-circle text-gray-400 cursor-pointer ml-1"
                                                    @mouseenter="open = true"
                                                    @mouseleave="open = false"
                                                    @click="open = !open"></i>

                                                <!-- กล่อง Tooltip -->
                                                <div x-show="open"
                                                    x-transition:enter="transition ease-out duration-200"
                                                    x-transition:enter-start="opacity-0 scale-95"
                                                    x-transition:enter-end="opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-150"
                                                    x-transition:leave-start="opacity-100 scale-100"
                                                    x-transition:leave-end="opacity-0 scale-95"
                                                    style="display: none;"
                                                    class="absolute top-full left-1/2 -translate-x-1/2 mt-2 bg-gray-700 text-white text-xs rounded-lg p-3 w-max text-left shadow-xl z-50">
                                                    <div class="space-y-2">
                                                        <div class="flex items-center gap-3">
                                                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 inline-block shrink-0"></span>
                                                            <span class="whitespace-nowrap">ตรวจสอบผ่าน</span>
                                                        </div>
                                                        <div class="flex items-center gap-3">
                                                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500 inline-block shrink-0"></span>
                                                            <span class="whitespace-nowrap">มีรายการตรวจสอบไม่ผ่าน</span>
                                                        </div>
                                                        <div class="flex items-center gap-3">
                                                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block shrink-0"></span>
                                                            <span class="whitespace-nowrap">มีรายการที่ไม่ได้ตรวจสอบ</span>
                                                        </div>
                                                    </div>
                                                    <!-- ลูกศรชี้ขึ้นด้านบนของ Tooltip -->
                                                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 -mb-px border-4 border-transparent border-b-gray-700"></div>
                                                </div>
                                            </span>
                                        </th>
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
                                            @php
                                            // ดึงสถานะทั้งหมดที่มีอยู่ในใบตรวจนี้
                                            $statuses = $item->checklistResults->pluck('status')->unique();
                                            $notPass = $statuses->contains(2); // มีสถานะไม่ผ่าน
                                            $notInspec = $statuses->contains(3); // มีสถานะไม่ได้ตรวจ
                                            $isAllPass = $statuses->isNotEmpty() && !$notPass && !$notInspec && $statuses->every(fn($s) => $s == 1);
                                            @endphp
                                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-200 dark:bg-gray-500">
                                                @if($isAllPass)
                                                {{-- ผ่านทั้งหมด แสดงสีเขียวสีเดียว --}}
                                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500" title="ตรวจสอบผ่าน"></span>
                                                @else
                                                {{-- ถ้ามีไม่ผ่านหรือไม่ได้ตรวจ แสดงสีแดง/เหลืองตามที่มี --}}
                                                @if($notPass)
                                                <span class="w-2.5 h-2.5 rounded-full bg-rose-500" title="มีรายการตรวจสอบไม่ผ่าน"></span>
                                                @endif
                                                @if($notInspec)
                                                <span class="w-2.5 h-2.5 rounded-full bg-amber-400" title="มีรายการที่ไม่ได้ตรวจสอบ"></span>
                                                @endif
                                                {{-- เผื่อกรณีไม่มีข้อมูลผลตรวจเลย --}}
                                                @if(!$notPass && !$notInspec && $statuses->isEmpty())
                                                <span class="text-xs">-</span>
                                                @endif
                                                @endif
                                            </span>
                                        </td>
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
                                        <td colspan="8" class="text-center py-6 text-gray-500">
                                            ✅ ไม่มีรายการผิดปกติ
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-gray-100 dark:bg-gray-700 border-t border-gray-300 dark:border-gray-600">
                                    <tr>
                                        <td colspan="8" class="px-3 py-2 text-right text-sm font-semibold">
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
        @include('inspection.modal-inspection-report', ['typeReport' => 'exception'])
    </div>
    <x-toast-validation />
    <x-toast />
</x-app-layout>
