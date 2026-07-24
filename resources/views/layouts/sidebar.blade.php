<aside class="fixed inset-x-0 bottom-0 z-40 border-t border-slate-200 bg-white/95 px-2 py-2 shadow-[0_-8px_24px_rgba(15,23,42,0.08)] backdrop-blur dark:border-gray-800 dark:bg-gray-900/95 lg:inset-x-auto lg:inset-y-0 lg:left-0 lg:w-20 lg:border-r lg:border-t-0 lg:px-0 lg:py-4 lg:shadow-none">

    <!-- Logo -->
    <div class="hidden shrink-0 items-center justify-center lg:flex">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </a>
    </div>

    <!-- Menu -->
    <nav class="flex items-stretch gap-1 overflow-x-auto text-xs text-slate-600 scrollbar-thin scrollbar-thumb-slate-300 dark:text-gray-300 dark:scrollbar-thumb-gray-700 lg:mt-6 lg:flex-col lg:items-center lg:gap-3 lg:overflow-visible lg:text-sm">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="sidebar-item relative group
                {{ request()->routeIs('dashboard')
                        ? '!bg-teal-100 !text-teal-900 font-semibold ring-1 ring-teal-300 dark:!bg-teal-950/60 dark:!text-teal-300 dark:ring-teal-900'
                        : '' }}">
            <i class="bi bi-speedometer2 sideber-icon"></i>
            <span>Dashboard</span>

            <!-- Tooltip -->
            <div class="absolute left-full ml-2 px-2.5 py-1 bg-gray-900 text-white text-xs rounded-md shadow-md 
                opacity-0 pointer-events-none transition-opacity duration-300 group-hover:opacity-100 
                dark:bg-gray-700 whitespace-nowrap z-50">
                Dashboard
            </div>
        </a>

        <!-- รายละเอียดตรวจเช็คเครื่องปั่นไฟ -->
        <a href="{{ route('inspection.index') }}"
            class="sidebar-item relative group 
            {{ request()->routeIs('inspection.index') || request()->routeIs('inspection.view')
                ? '!bg-teal-100 !text-teal-900 font-semibold ring-1 ring-teal-300 dark:!bg-teal-950/60 dark:!text-teal-300 dark:ring-teal-900' 
                : '' }}">

            <i class="bi bi-clipboard2-check sideber-icon"></i>
            <span>รายละเอียดตรวจเช็คเครื่องปั่นไฟ</span>

            <!-- Tooltip -->
            <div class="absolute left-full ml-2 px-2.5 py-1 bg-gray-900 text-white text-xs rounded-md shadow-md 
                opacity-0 pointer-events-none transition-opacity duration-300 group-hover:opacity-100 
                dark:bg-gray-700 whitespace-nowrap z-50">
                รายละเอียดตรวจเช็คเครื่องปั่นไฟ
            </div>
        </a>

        <!-- รายการตรวจเช็คเครื่องปั่นไฟไม่ผ่าน -->
        <a href="{{ route('inspection.exception') }}"
            class="sidebar-item relative group
                {{ request()->routeIs('inspection.exception')
                        ? '!bg-teal-100 !text-teal-900 font-semibold ring-1 ring-teal-300 dark:!bg-teal-950/60 dark:!text-teal-300 dark:ring-teal-900'
                        : '' }}">
            <i class="bi bi-exclamation-octagon sideber-icon"></i>
            <span>รายการตรวจเช็คเครื่องปั่นไฟไม่ผ่าน</span>

            <!-- Tooltip -->
            <div class="absolute left-full ml-2 px-2.5 py-1 bg-gray-900 text-white text-xs rounded-md shadow-md 
                opacity-0 pointer-events-none transition-opacity duration-300 group-hover:opacity-100 
                dark:bg-gray-700 whitespace-nowrap z-50">
                รายการตรวจเช็คเครื่องปั่นไฟไม่ผ่าน
            </div>
        </a>

        <!-- ปฏิทินการตรวจเช็ค -->
        <a href="{{ route('inspection.calendar')}}"
            class="sidebar-item relative group
                {{ request()->routeIs('inspection.calendar')
                        ? '!bg-teal-100 !text-teal-900 font-semibold ring-1 ring-teal-300 dark:!bg-teal-950/60 dark:!text-teal-300 dark:ring-teal-900'
                        : '' }}">
            <i class="bi bi-calendar3 sideber-icon"></i>
            <span>ปฏิทินการตรวจเช็ค</span>

            <!-- Tooltip -->
            <div class="absolute left-full ml-2 px-2.5 py-1 bg-gray-900 text-white text-xs rounded-md shadow-md 
                opacity-0 pointer-events-none transition-opacity duration-300 group-hover:opacity-100 
                dark:bg-gray-700 whitespace-nowrap z-50">
                ปฏิทินการตรวจเช็ค
            </div>
        </a>

        <!-- Divider -->
        <div class="hidden w-full items-center gap-2 text-xs text-gray-400 dark:text-gray-500 lg:flex">
            <div class="h-px flex-1 bg-gray-300 dark:bg-gray-600"></div>
            <span>การตั้งค่า</span>
            <div class="h-px flex-1 bg-gray-300 dark:bg-gray-600"></div>
        </div>

        <!-- บันทึกข้อมูลเครื่องปั่นไฟ -->
        <a href="{{ route('generator.index') }}"
            class="sidebar-item relative group
                {{ request()->routeIs('generator.index')
                        ? '!bg-teal-100 !text-teal-900 font-semibold ring-1 ring-teal-300 dark:!bg-teal-950/60 dark:!text-teal-300 dark:ring-teal-900'
                        : '' }}">
            <i class="bi bi-hdd-stack sideber-icon"></i>
            <span>บันทึกข้อมูลเครื่องปั่นไฟ</span>

            <!-- Tooltip -->
            <div class="absolute left-full ml-2 px-2.5 py-1 bg-gray-900 text-white text-xs rounded-md shadow-md 
                opacity-0 pointer-events-none transition-opacity duration-300 group-hover:opacity-100 
                dark:bg-gray-700 whitespace-nowrap z-50">
                บันทึกข้อมูลเครื่องปั่นไฟ
            </div>
        </a>

        <!-- ตั้งค่ารายการตรวจเช็ค -->
        <a href="{{ route('checklist.index') }}"
            class="sidebar-item relative group
                {{ request()->routeIs('checklist.index')
                        ? '!bg-teal-100 !text-teal-900 font-semibold ring-1 ring-teal-300 dark:!bg-teal-950/60 dark:!text-teal-300 dark:ring-teal-900'
                        : '' }}">
            <i class="bi bi-ui-checks-grid sideber-icon"></i>
            <span>ตั้งค่ารายการตรวจเช็ค</span>

            <!-- Tooltip -->
            <div class="absolute left-full ml-2 px-2.5 py-1 bg-gray-900 text-white text-xs rounded-md shadow-md 
                opacity-0 pointer-events-none transition-opacity duration-300 group-hover:opacity-100 
                dark:bg-gray-700 whitespace-nowrap z-50">
                ตั้งค่ารายการตรวจเช็ค
            </div>
        </a>

    </nav>
</aside>