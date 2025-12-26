<div class="flex justify-between items-center">
    <form method="GET">
        <label class="text-sm text-gray-600 dark:text-gray-300 mr-2">
            แสดงต่อหน้า
        </label>
        <div class="relative inline-block">
            <select
                name="per_page"
                onchange="this.form.submit()"
                class="appearance-none rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm px-3 py-1 pr-6">
                @foreach ([10,20,50,100] as $size)
                <option value="{{ $size }}"
                    {{ request('per_page', 20) == $size ? 'selected' : '' }}>
                    {{ $size }}
                </option>
                @endforeach
            </select>

            <!-- ลูกศร -->
            <div class="pointer-events-none absolute inset-y-0 right-1 flex items-center text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
    </form>
</div>