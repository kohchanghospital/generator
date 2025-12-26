<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
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
    <div>
        {{ $lists->links() }}
    </div>
    @endif
</div>