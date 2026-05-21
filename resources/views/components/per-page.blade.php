<div class="flex w-full items-center justify-start sm:w-auto sm:justify-between">
    <form method="GET" class="flex w-full items-center gap-2 sm:w-auto">
        <label class="shrink-0 text-sm text-gray-600 dark:text-gray-300">
            แสดงต่อหน้า
        </label>
        <div class="relative inline-block flex-1 sm:flex-none">
            <select
                name="per_page"
                onchange="this.form.submit()"
                class="w-full appearance-none rounded-lg border border-gray-300 bg-white px-3 py-2 pr-8 text-sm dark:border-gray-600 dark:bg-gray-800 sm:w-auto">
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
