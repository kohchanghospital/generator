@if(session('toast_type'))
<div
    x-data="{
        toasts: [],
        addToast(toast) {
            const id = Date.now()
            this.toasts.push({ id, ...toast })

            setTimeout(() => {
                this.toasts = this.toasts.filter(t => t.id !== id)
            }, 5000)
        }
    }"
    x-init="
        addToast({
            type: '{{ session('toast_type') }}',
            message: '{{ session('toast_message') }}'
        })
    "
    class="fixed top-5 right-5 z-50 w-80 space-y-3"
>
    <template x-for="(toast, index) in toasts" :key="toast.id">
        <div
            x-transition
            class="rounded-lg shadow-lg px-4 py-3 flex items-start gap-3 border"
            :class="{
                'bg-green-50 border-green-300 text-green-800': toast.type === 'create',
                'bg-blue-50 border-blue-300 text-blue-800': toast.type === 'update',
                'bg-orange-50 border-orange-300 text-orange-800': toast.type === 'delete',
                'bg-red-50 border-red-300 text-red-800': toast.type === 'error'
            }"
        >
            <!-- Icon -->
            <div class="text-xl">
                <span x-show="toast.type === 'create'">➕</span>
                <span x-show="toast.type === 'update'">✏️</span>
                <span x-show="toast.type === 'delete'">🗑️</span>
                <span x-show="toast.type === 'error'">❌</span>
            </div>

            <!-- Content -->
            <div class="flex-1 text-sm">
                <p class="font-semibold">
                    <span x-show="toast.type === 'create'">เพิ่มข้อมูลสำเร็จ</span>
                    <span x-show="toast.type === 'update'">อัปเดตข้อมูลสำเร็จ</span>
                    <span x-show="toast.type === 'delete'">ลบข้อมูลสำเร็จ</span>
                    <span x-show="toast.type === 'error'">เกิดข้อผิดพลาด</span>
                </p>
                <p x-text="toast.message"></p>
            </div>

            <!-- Close -->
            <button
                @click="toasts.splice(index, 1)"
                class="text-gray-400 hover:text-gray-700"
            >
                ✕
            </button>
        </div>
    </template>
</div>
@endif

<script>
function toastStack() {
    return {
        toasts: [],
        addToast(toast) {
            const id = Date.now();
            this.toasts.push({
                id,
                ...toast,
                show: true
            });

            // auto remove
            setTimeout(() => {
                this.removeById(id);
            }, 3000);
        },
        removeToast(index) {
            this.toasts.splice(index, 1);
        },
        removeById(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
    }
}
</script>