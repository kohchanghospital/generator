<div class="space-y-4 text-sm text-gray-900 dark:text-gray-100">

    <div class="flex justify-between">
        <div>
            <b>เลขที่ใบตรวจ:</b> {{ $inspection->inspection_no }}
        </div>
        <div>
            <b>วันที่:</b>
            {{ \Carbon\Carbon::parse(
                $inspection->inspection_date.' '.$inspection->inspection_time
            )->format('d/m/Y H:i') }} น.
        </div>
    </div>

    <div><b>เครื่องปั่นไฟ:</b>
        {{ $inspection->generator->machine_code }}
        | {{ $inspection->generator->asset_name }}
    </div>

    <div><b>ผู้บันทึก:</b> {{ $inspection->user->name }}</div>

    <div><b>หมายเหตุ:</b> {{ $inspection->remark ?? '-' }}</div>

    <table class="w-full border mt-4 border-gray-200 dark:border-gray-700 text-xs">
        <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
                <th class="px-3 py-2">#</th>
                <th class="px-3 py-2 text-left">รายการตรวจ</th>
                <th class="px-3 py-2">สถานะ</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($inspection->checklistResults as $i)
            <tr class="border-t">
                <td class="px-3 py-2 text-center">{{ $loop->iteration }}</td>
                <td class="px-3 py-2">{{ $i->checklist->checklist_name }}</td>
                <td class="px-3 py-2 text-center">
                    @switch($i->status)
                    @case(1) ✅ ผ่าน @break
                    @case(2) ❌ ไม่ผ่าน @break
                    @default ⏺ ไม่ได้ตรวจ
                    @endswitch
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>