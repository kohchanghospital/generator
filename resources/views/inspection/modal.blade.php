<div>
    <!-- Modal Background -->
    <div
        x-show="open"
        x-transition
        class="fixed inset-0 bg-black bg-opacity-50 z-40"
        @click="open = false">
    </div>

    <!-- Modal -->
    <div
        x-show="open"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center px-4">

        <div class="bg-white dark:bg-gray-800 w-full max-w-4xl rounded-lg shadow-lg">

            <!-- Header -->
            <div class="flex justify-between items-center px-6 py-4 border-b dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                    <span x-show="mode === 'view'">ดูข้อมูลการตรวจเช็คเครื่องปั่นไฟ</span>
                    <span x-show="mode === 'create'">บันทึกข้อมูลการตรวจเช็คเครื่องปั่นไฟ</span>
                    <span x-show="mode === 'edit'">แก้ไขข้อมูลการตรวจเช็คเครื่องปั่นไฟ</span>
                </h2>
                <button @click="open = false" class="text-gray-500 hover:text-red-500 text-xl">
                    ✕
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <form
                    method="POST"
                    :action="mode === 'create'
                        ? '{{ route('inspection.store') }}'
                        : '{{ url('inspection') }}/' + current.id">
                    @csrf
                    <template x-if="mode === 'edit'">
                        @method('PUT')
                    </template>

                    <fieldset
                        :disabled="mode === 'view'"
                        :class="mode === 'view'
                            ? 'opacity-70 grayscale pointer-events-none'
                            : ''">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6 items-end">
                            {{-- เลขที่ใบตรวจ --}}
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-medium">
                                    เลขที่ใบตรวจ :
                                </label>
                                <input
                                    type="text"
                                    name="inspection_no"
                                    x-model="current.inspection_no"
                                    value=""
                                    required
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
                                    placeholder="กรอกหมายเหตุ"
                                    class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                        bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                        focus:ring-2 focus:ring-green-500 focus:outline-none">
                            </div>
                            {{-- ตารางตรวจสอบ --}}
                            <div class="md:col-span-4">
                                <label class="block mb-2 text-sm font-medium">
                                    ตารางตรวจสอบ :
                                </label>
                                <div class="max-h-[40vh] md:max-h-[50vh] overflow-y-auto border scrollbar-thin scrollbar-thumb-gray-400 dark:scrollbar-thumb-gray-600 border-gray-200 dark:border-gray-700 rounded-lg">
                                    <table class="min-w-full table-auto border-gray-200 dark:border-gray-700 rounded-lg ">
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
                                                        name="results[{{ $item->id }}][status]"
                                                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                                                            bg-gray-50 dark:bg-gray-800 px-4 py-2 
                                                            focus:ring-2 focus:ring-green-500 focus:outline-none">
                                                        <option value="1">ผ่าน</option>
                                                        <option value="2">ไม่ผ่าน</option>
                                                        <option selected value="3">ไม่ได้ตรวจสอบ</option>
                                                    </select>
                                                </td>
                                                <td class="px-4 py-1">
                                                    <input
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
                    </fieldset>
                    <!-- Footer -->
                    <div class="flex justify-end gap-3">
                        <button
                            type="button"
                            @click="open = false"
                            class="px-5 py-2 rounded-lg border border-gray-300 dark:border-gray-600">
                            <span x-show="mode !== 'view'">ยกเลิก</span>
                            <span x-show="mode === 'view'">ปิด</span>
                        </button>
                        <button
                            x-show="mode !== 'view'"
                            type="submit"
                            class="px-6 py-2 bg-green-600 hover:bg-green-700
                                text-white font-semibold rounded-lg">
                            <span x-show="mode === 'create'">บันทึกข้อมูล</span>
                            <span x-show="mode === 'edit'">อัปเดตข้อมูล</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>