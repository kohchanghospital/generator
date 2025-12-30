<x-app-layout>
    <x-slot name="header">
        <div class="flex sticky justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('ปฏิทินการตรวจเช็คเครื่องปั่นไฟ') }}
            </h2>
            <a href="#" class="absolute top-0 right-0 btn btn-primary text-gray-800 dark:text-gray-200 leading-tight">
                <i class="bi bi-file-earmark-arrow-down"></i> Generate Report
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- FullCalendar (CDN : ไม่ใช้ Vite) --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            if (!calendarEl) return;

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'th',
                height: 'auto',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },

                events: '{{ route("inspection.calendar.events") }}',

                eventClick(info) {
                    info.jsEvent.preventDefault();
                    if (info.event.url) {
                        window.open(info.event.url, '_blank');
                    }
                }
            });

            calendar.render();
        });
    </script>
    <style>
        /* ===================== */
        /* 🌤 LIGHT MODE */
        /* ===================== */
        .fc .fc-toolbar {
            background-color: #f8fafc;
            /* slate-50 */
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 12px;
        }

        .fc .fc-toolbar-title {
            color: #0f172a;
            /* slate-900 */
            font-weight: 600;
        }

        .fc .fc-button {
            background-color: #e5e7eb;
            /* gray-200 */
            border: none;
            color: #111827;
            border-radius: 8px;
        }

        .fc .fc-button:hover {
            background-color: #d1d5db;
        }

        .fc .fc-col-header-cell {
            background-color: #f1f5f9;
            /* slate-100 */
        }

        .fc .fc-col-header-cell-cushion {
            color: #1e293b;
            font-weight: 500;
        }

        .fc-theme-standard td,
        .fc-theme-standard th {
            border-color: #cbd5e1;
        }


        /* ===================== */
        /* 🌙 DARK MODE */
        /* ===================== */
        .dark .fc .fc-toolbar {
            background-color: #020617;
            /* slate-950 */
        }

        .dark .fc .fc-toolbar-title {
            color: #f8fafc;
        }

        .dark .fc .fc-button {
            background-color: #1e293b;
            /* slate-800 */
            color: #e5e7eb;
        }

        .dark .fc .fc-button:hover {
            background-color: #334155;
        }

        .dark .fc .fc-col-header-cell {
            background-color: #020617;
        }

        .dark .fc .fc-col-header-cell-cushion {
            color: #e5e7eb;
        }

        .dark .fc-theme-standard td,
        .dark .fc-theme-standard th {
            border-color: #334155;
        }
    </style>


</x-app-layout>