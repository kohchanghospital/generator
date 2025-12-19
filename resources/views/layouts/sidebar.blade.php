<aside class="fixed inset-y-0 left-0 w-20 bg-gray-50 dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col items-center py-4 space-y-6">
    
    <!-- Hamburger / Logo -->
    <div class="text-teal-500 text-2xl font-bold">
        ☰
    </div>

    <!-- Menu -->
    <nav class="flex flex-col items-center space-y-5 text-sm text-gray-600 dark:text-gray-300">
        
        <a href="{{ route('dashboard') }}" class="sidebar-item">
            <span class="sideber-icon">📊</span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('checklist.index') }}" class="sidebar-item">
            <span class="sideber-icon">📋</span>
            <span>รายละเอียดตรวจเช็คเครื่องปั่นไฟ</span>
        </a>

        <a href="{{ route('checklist.failed') }}" class="sidebar-item">
            <span class="sideber-icon">⛔️</span>
            <span>รายการตรวจเช็คเครื่องปั่นไฟไม่ผ่าน</span>
        </a>

        <a href="#" class="sidebar-item">
            <span class="sideber-icon">🗓️</span>
            <span>ปฏิทินการตรวจเช็ค</span>
        </a>
        <div class="w-full flex items-center gap-2 text-gray-400 dark:text-gray-500 text-xs">
            <div class="flex-1 h-px bg-gray-300 dark:bg-gray-600"></div>
            <span>⚙️การตั้งค่า</span>
            <div class="flex-1 h-px bg-gray-300 dark:bg-gray-600"></div>
        </div>

        <a href="{{ route('generator.index') }}" class="sidebar-item">
            <span class="sideber-icon">📁</span>
            <span>บันทึกข้อมูลเครื่องปั่นไฟ</span>
        </a>

        <a href="#" class="sidebar-item">
            <span class="sideber-icon">✏️</span>
            <span>ตั้งค่ารายการตรวจเช็ค</span>
        </a>

    </nav>
</aside>
