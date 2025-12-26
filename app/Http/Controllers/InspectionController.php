<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspection;
use App\Models\Generator;
use App\Models\Checklist;

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

        $lists = Inspection::latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('inspection.index', [
            'generators' => $generators,
            'checklist' => $checklist,
            'lists' => $lists,
        ]);
    }

    // หน้าเพิ่มข้อมูล
    public function create()
    {
        return view('inspection.create');
    }

    // บันทึกข้อมูล
    public function store(Request $request)
    {
        $data = $request->validate([
            'generator_id'    => 'required|exists:generators,id',
            'remark'          => 'nullable|string',
        ]);

        Inspection::create([
            'inspection_date' => now()->toDateString(),
            'inspection_time' => now()->toTimeString(),
            ...$data,
            'user_id' => auth()->id(), // บังคับจากระบบ
        ]);

        return redirect()
            ->route('inspection.index')
            ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    // ดูรายละเอียด
    public function show($id)
    {
        $item = Inspection::with(['items.checklist'])->findOrFail($id);

        return view('inspection.show', compact('item'));
    }

    // ลบ
    public function destroy($id)
    {
        Inspection::findOrFail($id)->delete();

        return back()->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
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
}
