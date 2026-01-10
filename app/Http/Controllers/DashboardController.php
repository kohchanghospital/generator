<?php

namespace App\Http\Controllers;

use App\Models\Inspection;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $latestInspection = Inspection::latest()->first();

        return view('dashboard', [

            'monthCount' => Inspection::whereMonth('inspection_date', now()->month)
                ->whereYear('inspection_date', now()->year)
                ->count(),

            'passCount' => Inspection::whereHas('checklistResults', function ($q) {
                $q->where('status', 1);
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
}
