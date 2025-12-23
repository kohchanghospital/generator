<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneratorChecklist;

class CheckSheetController extends Controller

{
    // หน้าแสดงตาราง
    public function index()
    {
        $lists = GeneratorChecklist::all();
        return view('check_sheet.index', compact('lists'));
    }

    // หน้าเพิ่มข้อมูล
    public function create()
    {
        return view('check_sheet.create');
    }

    // บันทึกข้อมูล
    public function store(Request $request)
    {
        GeneratorChecklist::create($request->all());
        return redirect()->route('check_sheet.index');
    }

    // ดูรายละเอียด
    public function show($id)
    {
        $item = GeneratorChecklist::findOrFail($id);
        return view('check_sheet.show', compact('item'));
    }

    // ลบ
    public function destroy($id)
    {
        GeneratorChecklist::findOrFail($id)->delete();
        return back();
    }

        // หน้าแสดงตาราง
    public function failed()
    {
        $lists = GeneratorChecklist::all();
        return view('check_sheet.failed', compact('lists'));
    }
}
