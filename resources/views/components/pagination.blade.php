<div class="flex flex-col gap-3 text-left sm:flex-row sm:items-center sm:justify-between">
    {{-- ข้อความจำนวนรายการ --}}
    <div class="text-sm text-gray-600 dark:text-gray-400">
        แสดง
        {{ $lists->firstItem() ?? 1 }}
        ถึง
        {{ $lists->lastItem() ?? $lists->total() }}
        จากทั้งหมด
        {{ $lists->total() }}
        รายการ
    </div>
    {{-- ปุ่ม pagination --}}
    @if ($lists->hasPages())
    <div class="overflow-x-auto">
        {{ $lists->links() }}
    </div>
    @endif
</div>
