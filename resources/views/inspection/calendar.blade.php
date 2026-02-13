<div
    x-data="{ open: false }">
    <x-app-layout>

        <x-slot name="header">
            <div class="flex sticky justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('ปฏิทินการตรวจเช็คเครื่องปั่นไฟ') }}
                </h2>

            </div>
        </x-slot>
        <div class="grid justify-items-end">
            <button
                @click="
            open = true;
            if (calendar) {
                const d = calendar.getDate();
                document.getElementById('selectedMonth').value = d.getMonth() + 1;
                document.getElementById('selectedYear').value = d.getFullYear();
            }
        "
                class="btn btn-primary text-gray-800 dark:text-gray-200 leading-tight">
                <i class="bi bi-file-earmark-arrow-down"></i> Export Report
            </button>
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 ">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

            {{-- Alpine modal --}}
            @include('inspection.modal-calendar')
        </div>

    </x-app-layout>
</div>

{{-- FullCalendar (CDN : ไม่ใช้ Vite) --}}
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input[name="mode"]').forEach(radio => {
            radio.addEventListener('change', e => {

                document.getElementById('monthPicker').style.display =
                    e.target.value === 'custom' ? 'block' : 'none';

                document.getElementById('rangePicker').style.display =
                    e.target.value === 'range' ? 'block' : 'none';
            });
        });
    });
</script>

<script>
    let calendar;

    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        if (!calendarEl) return;

        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'th',
            height: 'auto',

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },

            events: '{{ route("inspection.calendar.events") }}',
            eventClick: function(info) {
                info.jsEvent.preventDefault(); // กันเปิดแท็บเดิม
                if (info.event.url) {
                    window.open(info.event.url, '_blank');
                }
            }
        });

        calendar.render();
    });
</script>

<style>
    .fc .fc-toolbar {
        background-color: #f8fafc;
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 12px;
    }

    .fc .fc-toolbar-title {
        color: #0f172a;
        font-weight: 600;
    }

    .fc .fc-button {
        background-color: #e5e7eb;
        border: none;
        color: #111827;
        border-radius: 8px;
    }

    .fc .fc-button:hover {
        background-color: #d1d5db;
    }

    .fc .fc-col-header-cell {
        background-color: #f1f5f9;
    }

    .fc .fc-col-header-cell-cushion {
        color: #1e293b;
        font-weight: 500;
    }

    .fc-theme-standard td,
    .fc-theme-standard th {
        border-color: #cbd5e1;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>