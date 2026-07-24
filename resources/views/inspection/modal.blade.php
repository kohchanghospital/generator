<div
    x-show="open"
    x-transition
    x-cloak
    class="fixed inset-0 z-50 flex items-end sm:items-center justify-center overflow-y-auto p-3 sm:p-6"
    style="padding-top: max(1rem, env(safe-area-inset-top)); padding-bottom: max(1rem, env(safe-area-inset-bottom));">
    
    <div class="flex max-h-[calc(100dvh-2rem)] w-full max-w-5xl flex-col overflow-hidden rounded-2xl bg-white shadow-xl dark:bg-gray-800">
        <!-- Header -->
        <div class="flex items-start justify-between gap-4 border-b px-4 py-4 dark:border-gray-700 sm:px-6 shrink-0">
            <h2 class="text-base font-semibold text-gray-800 dark:text-gray-200 sm:text-lg">
                <span x-show="mode === 'view'">ข้อมูลการตรวจเช็คเครื่องปั่นไฟ</span>
                <span x-show="mode === 'create'">บันทึกข้อมูลการตรวจเช็คเครื่องปั่นไฟ</span>
                <span x-show="mode === 'edit'">แก้ไขข้อมูลการตรวจเช็คเครื่องปั่นไฟ</span>
            </h2>
            <button type="button" @click="open = false" class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-gray-500 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-950/40">
                ✕
            </button>
        </div>
        <!-- Body -->
        <div class="overflow-y-auto p-4 text-gray-900 dark:text-gray-100 sm:p-6 flex-1">
                <form
                    method="POST"
                    :action="mode === 'create'
                        ? '{{ route('inspection.store') }}'
                        : '{{ route('inspection.update', ':id') }}'.replace(':id', current.id)">
                    @csrf
                    <template x-if="mode === 'edit'">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <div class="mb-6 grid grid-cols-1 items-end gap-4 md:grid-cols-4 md:gap-6">
                        {{-- เลขที่ใบตรวจ --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-medium">
                                เลขที่ใบตรวจ :
                            </label>
                            <input
                                type="text"
                                name="inspection_no"
                                x-model="current.inspection_no"
                                disabled
                                placeholder="INS-2025-00XX"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                        bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                        focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>
                        {{-- วันที่ตรวจ --}}
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-sm font-medium">
                                วันที่ตรวจ :
                            </label>
                            <input
                                type="date"
                                name="inspection_date"
                                x-model="current.inspection_date"
                                required
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                        bg-gray-50 dark:bg-gray-800 px-4 py-2
                                        focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>
                        {{-- เวลาที่ตรวจ --}}
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-sm font-medium">
                                เวลาที่ตรวจ :
                            </label>
                            <input
                                type="time"
                                name="inspection_time"
                                x-model="current.inspection_time"
                                required
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                        bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                        focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>
                        {{-- เครื่องปั่นไฟ --}}
                        <div class="md:col-span-4">
                            <label class="block mb-2 text-sm font-medium">
                                เครื่องปั่นไฟ :
                            </label>
                            <select
                                required
                                name="generator_id"
                                id="generator_id"
                                x-model="current.generator_id"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                        bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                        focus:ring-2 focus:ring-green-500 focus:outline-none">
                                <option value="">-- เลือกเครื่องปั่นไฟ --</option>
                                @foreach ($generators as $generator)
                                <option value="{{ $generator->id }}">
                                    {{ $generator->machine_code }} | {{ $generator->asset_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- หมายเหตุ --}}
                        <div class="md:col-span-4">
                            <label class="block mb-2 text-sm font-medium">
                                หมายเหตุ :
                            </label>
                            <input
                                type="text"
                                name="remark"
                                x-model="current.remark"
                                :placeholder="mode !== 'view' ? 'กรอกหมายเหตุ' : '-'"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                        bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                        focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>
                        {{-- ตารางตรวจสอบ --}}
                        <div class="md:col-span-4">
                            <label class="block mb-2 text-sm font-medium">
                                ตารางตรวจสอบ :
                            </label>
                            <div class="max-h-[40vh] overflow-auto rounded-lg border border-gray-200 scrollbar-thin scrollbar-thumb-gray-400 dark:border-gray-700 dark:scrollbar-thumb-gray-600 md:max-h-[45vh]">
                                <table class="w-full min-w-[760px] table-auto border-gray-200 dark:border-gray-700">
                                    <thead class="bg-gray-100 dark:bg-gray-700 sticky top-0 z-10">
                                        <tr>
                                            <th class="px-4 py-3 text-center text-sm font-semibold">ลำดับ</th>
                                            <th class="px-4 py-3 text-left text-sm font-semibold">รายการตรวจสอบ</th>
                                            <th class="px-4 py-3 text-left text-sm font-semibold">สถานะ</th>
                                            <th class="px-4 py-3 text-left text-sm font-semibold">หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($checklist as $item)
                                        <tr>
                                            <td class="px-1 py-1 text-center text-gray-500">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-4 py-1">
                                                {{ $item->checklist_name }}
                                            </td>
                                            <td class="px-4 py-1">
                                                <select
                                                    :value="current.checklist?.[{{ $item->id }}]?.status ?? 3"
                                                    name="results[{{ $item->id }}][status]"
                                                    class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                                            bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                                            focus:ring-2 focus:ring-green-500 focus:outline-none">
                                                    <option value="1">ผ่าน</option>
                                                    <option value="2">ไม่ผ่าน</option>
                                                    <option value="3">ไม่ได้ตรวจสอบ</option>
                                                </select>
                                            </td>
                                            <td class="px-4 py-1">
                                                <input
                                                    :value="current.checklist?.[{{ $item->id }}]?.remark ?? ''"
                                                    name="results[{{ $item->id }}][remark]"
                                                    class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                                            bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                                            focus:ring-2 focus:ring-green-500 focus:outline-none"
                                                    type="text">
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3"
                                                class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                                🚫 ไม่มีข้อมูลรายการตรวจเช็ค
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            @click="open = false"
                            class="w-full rounded-lg border border-gray-300 px-5 py-2 dark:border-gray-600 sm:w-auto">
                            <span>ยกเลิก</span>
                        </button>
                        <button
                            type="submit"
                            class="w-full rounded-lg bg-green-600 px-6 py-2 font-semibold text-white hover:bg-green-700 sm:w-auto">
                            <span x-show="mode === 'create'">บันทึกข้อมูล</span>
                            <span x-show="mode === 'edit'">อัปเดตข้อมูล</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
