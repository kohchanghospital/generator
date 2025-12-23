@if ($errors->any())
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        class="fixed top-5 right-5 z-50 bg-red-50 border border-red-300
            text-red-800 px-4 py-3 rounded-lg shadow-lg w-80">
        ❌ กรุณากรอกข้อมูลให้ครบถ้วน
    </div>
@endif
