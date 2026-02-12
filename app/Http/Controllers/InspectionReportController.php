<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspection;
use Barryvdh\DomPDF\Facade\Pdf;

class InspectionReportController extends Controller
{
    public function report(Request $request)
    {
        $from = $request->from_month;
        $to   = $request->to_month;

        // บังคับ PDF เท่านั้น
        $exportType = 'pdf';

        // ดึงข้อมูลตามช่วงเดือน
        $data = Inspection::whereBetween('inspection_month', [$from, $to])->get();

        // ตัวอย่างใช้ dompdf
        $pdf = Pdf::loadView('inspection.calendar_pdf', compact('data', 'from', 'to'));

        return $pdf->stream('inspection-report.pdf');
    }

    public function inspection(Request $request)
    {
        $limit = $request->limit;

        if ($limit === 'all') {
            $inspections = Inspection::latest()->get();
        } elseif ($limit === 'custom') {
            $inspections = Inspection::latest()
                ->limit((int)$request->custom_limit)
                ->get();
        } else {
            $inspections = Inspection::latest()
                ->limit((int)$limit)
                ->get();
        }

        $pdf = Pdf::loadView('inspection.report.inspection', compact('inspections'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('inspection-report.pdf');
    }

    public function exception(Request $request)
    {
        $limit = $request->limit;

        $query = Inspection::whereHas('checklistResults', function ($q) {
            $q->whereIn('status', [2, 3]);
        })
            ->with(['generator', 'user', 'checklistResults.checklist'])
            ->latest();

        // จัดการ limit แบบเดียวกับ inspection()
        if ($limit === 'all') {
            $inspections = $query->get();
        } elseif ($limit === 'custom') {
            $inspections = $query->limit((int)$request->custom_limit)->get();
        } else {
            $inspections = $query->limit((int)$limit)->get();
        }

        $pdf = Pdf::loadView(
            'inspection.report.inspection',
            compact('inspections')
        )
            ->setPaper('a4', 'portrait');

        return $pdf->stream('exception-report.pdf');
    }
}
