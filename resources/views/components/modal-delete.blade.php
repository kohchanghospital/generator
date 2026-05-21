<!-- Confirm Delete Modal -->
<div
    x-show="confirmDelete"
    x-transition
    x-cloak
    class="fixed inset-0 z-50 flex items-end justify-center p-3 sm:items-center sm:p-6"
>
    <!-- Background -->
    <div
        class="fixed inset-0 bg-black/30 backdrop-blur-[4px]"
        @click="confirmDelete = false"
    ></div>

    <!-- Modal Box -->
    <div class="relative z-10 w-full max-w-md rounded-2xl bg-white shadow-xl dark:bg-gray-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b dark:border-gray-700">
            <h2 class="text-lg font-semibold text-red-600">
                ⚠️ ยืนยันการลบข้อมูล
            </h2>
        </div>

        <!-- Body -->
        <div class="px-6 py-4 text-gray-700 dark:text-gray-200">
            คุณต้องการลบรายการ:
            <p class="mt-2 font-semibold text-red-500" x-text="deleteName"></p>
            <p class="mt-2 text-sm text-gray-500">
                การลบไม่สามารถย้อนกลับได้
            </p>
        </div>

        <!-- Footer -->
        <div class="flex flex-col-reverse gap-3 px-4 py-4 sm:flex-row sm:justify-end sm:px-6">
            <button
                @click="confirmDelete = false"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 dark:border-gray-600 sm:w-auto">
                ยกเลิก
            </button>

            <form
                class="sm:w-auto"
                method="POST"
                :action="baseUrl + '/' + deleteId"
            >
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="w-full rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700 sm:w-auto">
                    ลบข้อมูล
                </button>
            </form>
        </div>
    </div>
</div>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
