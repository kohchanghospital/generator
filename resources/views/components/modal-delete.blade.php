<!-- Confirm Delete Modal -->
<div
    x-show="confirmDelete"
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center px-4 "
>
    <!-- Background -->
    <div
        class="fixed inset-0 bg-black/30 backdrop-blur-[4px]"
        @click="confirmDelete = false"
    ></div>

    <!-- Modal Box -->
    <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md z-10">
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
        <div class="px-6 py-4 flex justify-end gap-3">
            <button
                @click="confirmDelete = false"
                class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600">
                ยกเลิก
            </button>

            <form
                method="POST"
                :action="baseUrl + '/' + deleteId"
            >
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    ลบข้อมูล
                </button>
            </form>
        </div>
    </div>
</div>

