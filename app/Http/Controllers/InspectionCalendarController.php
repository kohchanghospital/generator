<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Inspection;
use Illuminate\Http\Request;

class InspectionCalendarController extends Controller
{
    public function pdf(Request $request)
    {
        if ($request->mode === 'custom') {
            $month = (int) $request->month;
            $year  = (int) $request->year;
        } else {
            $month = now()->month;
            $year  = now()->year;
        }

        $start = Carbon::create($year, $month, 1);
        $end   = $start->copy()->endOfMonth();
        $calendarStart = $start->copy()->startOfWeek(Carbon::SUNDAY);

        $inspections = Inspection::whereBetween('inspection_date', [$start, $end])
            ->get()
            ->groupBy(fn($i) => Carbon::parse($i->inspection_date)->day);

        $pdf = Pdf::loadView('inspection.report.calendar', compact(
            'start',
            'end',
            'calendarStart',
            'inspections'
        ))
            ->setPaper('a4', 'landscape')
            ->setOption('defaultFont', 'thsarabun');

        // ✅ เปิดเป็น preview ใน browser
        return $pdf->stream("inspection-calendar-{$month}-{$year}.pdf");
    }
}
