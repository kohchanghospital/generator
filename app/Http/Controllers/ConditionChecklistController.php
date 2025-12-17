<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneratorChecklist;

class ConditionChecklistController extends Controller

{
    // หน้าแสดงตาราง
    public function index()
    {
        $lists = GeneratorChecklist::all();
        return view('generator.index', compact('lists'));
    }

    // หน้าเพิ่มข้อมูล
    public function create()
    {
        return view('generator.create');
    }

    // บันทึกข้อมูล
    public function store(Request $request)
    {
        GeneratorChecklist::create($request->all());
        return redirect()->route('checklist.index');
    }

    // ดูรายละเอียด
    public function show($id)
    {
        $item = GeneratorChecklist::findOrFail($id);
        return view('generator.show', compact('item'));
    }

    // ลบ
    public function destroy($id)
    {
        GeneratorChecklist::findOrFail($id)->delete();
        return back();
    }
}
