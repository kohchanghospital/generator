<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inspection;
use App\Models\Generator;
use App\Models\Checklist;
use App\Models\InspectionChecklist;
use Barryvdh\DomPDF\Facade\Pdf;


class InspectionController extends Controller
{
    // หน้าแสดงตารางทั้งหมด
    public function index(Request $request)
    {
        $generators = Generator::active()
            ->orderBy('machine_code')
            ->get();

        $checklist = Checklist::active()
            ->orderBy('id')
            ->get();

        $perPage = $request->get('per_page', 20);

        $lists = Inspection::with(['user', 'generator'])
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('inspection.index', compact(
            'generators',
            'checklist',
            'lists'
        ));
    }


    // หน้าเพิ่มข้อมูล
    public function create()
    {
        return view('inspection.create');
    }

    // บันทึกข้อมูล
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'inspection_date' => 'required|date',
                'inspection_time' => 'required',
                'generator_id'    => 'required|exists:generators,id',
                'remark'          => 'nullable|string',
                'results'         => 'required|array',
                'results.*.status' => 'required|in:1,2,3',
                'results.*.remark' => 'nullable|string',
            ]);

            DB::transaction(function () use ($validated) {

                // 1️⃣ create inspections (master)
                $inspection = Inspection::create([
                    'inspection_date' => $validated['inspection_date'],
                    'inspection_time' => $validated['inspection_time'],
                    'generator_id'    => $validated['generator_id'],
                    'remark'          => $validated['remark'] ?? null,
                    'user_id'         => auth()->id(),
                    // inspection_no จะถูก gen ใน booted()
                ]);

                // 2️⃣ create inspection_checklists (detail)
                foreach ($validated['results'] as $checklistId => $result) {
                    InspectionChecklist::create([
                        'inspection_id' => $inspection->id,
                        'checklist_id'  => $checklistId,
                        'status'        => $result['status'],
                        'remark'        => $result['remark'] ?? null,
                    ]);
                }
            });

            return redirect()
                ->route('inspection.index')
                ->with([
                    'toast_type' => 'create',
                    'toast_message' => 'เพิ่มรายการตรวจเช็คเรียบร้อยแล้ว'
                ]);
        } catch (\Exception $e) {

            return redirect()
                ->route('inspection.index')
                ->with([
                    'toast_type' => 'error',
                    'toast_message' => 'ไม่สามารถเพิ่มรายการตรวจเช็คได้'
                ]);
        }
    }

    // ดูรายละเอียด
    public function show(Inspection $inspection)
    {
        $inspection->load([
            'generator',
            'checklistResults' => function ($q) {
                $q->with('checklist');
            }
        ]);

        return response()->json($inspection);
    }


    // ลบ
    public function destroy($id)
    {
        try {
            Inspection::findOrFail($id)->delete();

            return redirect()
                ->route('inspection.index')
                ->with([
                    'toast_type' => 'delete',
                    'toast_message' => 'ลบรายการตรวจเช็คเรียบร้อยแล้ว'
                ]);
        } catch (\Exception $e) {

            return redirect()
                ->route('inspection.index')
                ->with([
                    'toast_type' => 'error',
                    'toast_message' => 'ไม่สามารถลบรายการตรวจเช็คได้'
                ]);
        }
    }

    // หน้าเฉพาะรายการ "ไม่ผ่าน"
    public function failed(Request $request)
    {
        $perPage = $request->get('per_page', 20);

        $lists = Inspection::whereHas('items', function ($q) {
            $q->where('status_id', 2); // 2 = ไม่ผ่าน
        })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('inspection.failed', compact('lists'));
    }

    public function previewNo()
    {
        $year = now()->year;

        $lastNo = DB::table('inspection_numbers')
            ->whereYear('created_at', $year)
            ->orderByDesc('id')
            ->value('inspection_no');

        $running = 1;
        if ($lastNo) {
            $running = (int) substr($lastNo, -4) + 1;
        }

        return response()->json([
            'inspection_no' => 'INS-' . $year . '-' . str_pad($running, 4, '0', STR_PAD_LEFT)
        ]);
    }

    public function pdf($id)
    {
        $inspection = Inspection::with([
            'generator',
            'user',
            'checklistResults.checklist'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('inspection.pdf', compact('inspection'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('inspection-'.$inspection->inspection_no.'.pdf');
    }

    public function view(Inspection $inspection)
    {
        $inspection->load([
            'user',
            'generator',
            'checklistResults.checklist'
        ]);

        return view('inspection.view', compact('inspection'));
    }
}
