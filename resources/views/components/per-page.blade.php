<div class="flex justify-between items-center">
    <form method="GET">
        <label class="text-sm text-gray-600 dark:text-gray-300 mr-2">
            แสดงต่อหน้า
        </label>
        <div class="relative inline-block">
            <select
                name="per_page"
                onchange="this.form.submit()"
                class="appearance-none rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm px-3 py-1 pr-8">
                @foreach ([10,20,50,100] as $size)
                <option value="{{ $size }}"
                    {{ request('per_page', 20) == $size ? 'selected' : '' }}>
                    {{ $size }}
                </option>
                @endforeach
            </select>
        </div>
    </form>
</div>