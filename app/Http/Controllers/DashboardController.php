<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $latestInspection = Inspection::latest()->first();

        return view('dashboard', [

            'monthCount' => Inspection::whereMonth('inspection_date', now()->month)
                ->whereYear('inspection_date', now()->year)
                ->count(),

            'passCount' => Inspection::whereDoesntHave('checklistResults', function ($q) {
                $q->where('status', '!=', 1);
            })->count(),

            'failCount' => Inspection::whereHas('checklistResults', function ($q) {
                $q->where('status', 2);
            })->count(),

            'notCheckedCount' => Inspection::whereHas('checklistResults', function ($q) {
                $q->where('status', 3);
            })->count(),

            'allCount' => Inspection::count(),

            'latestInspections' => Inspection::latest()->limit(1)->get(),

            'latestInspection' => $latestInspection,
        ]);
    }

    public function pdf()
    {
        $latestInspection = Inspection::latest()->first();
        return view('dashboard-preview', [
            'monthCount' => Inspection::whereMonth('inspection_date', now()->month)
                ->whereYear('inspection_date', now()->year)
                ->count(),

            'passCount' => Inspection::whereDoesntHave('checklistResults', function ($q) {
                $q->where('status', '!=', 1);
            })->count(),

            'failCount' => Inspection::whereHas('checklistResults', function ($q) {
                $q->where('status', 2);
            })->count(),

            'notCheckedCount' => Inspection::whereHas('checklistResults', function ($q) {
                $q->where('status', 3);
            })->count(),

            'allCount' => Inspection::count(),

            'latestInspections' => Inspection::latest()->limit(1)->get(),

            'latestInspection' => $latestInspection,
        ]);
    }

    public function exportPdf()
    {
        $monthCount = Inspection::whereMonth('inspection_date', now()->month)
            ->whereYear('inspection_date', now()->year)
            ->count();

        $allCount = Inspection::count();

        $passCount = Inspection::whereDoesntHave('checklistResults', function ($q) {
            $q->where('status', '!=', 1);
        })->count();

        $failCount = Inspection::whereHas('checklistResults', function ($q) {
            $q->where('status', 2);
        })->count();

        $notCheckedCount = Inspection::whereHas('checklistResults', function ($q) {
            $q->where('status', 3);
        })->count();

        $latestInspection = Inspection::with('checklistResults', 'user')
            ->latest()
            ->first();

        $pdf = Pdf::loadView('dashboard-pdf', compact(
            'monthCount',
            'allCount',
            'passCount',
            'failCount',
            'notCheckedCount',
            'latestInspection'
        ));

        return $pdf->stream('dashboard-report.pdf');
    }
}
