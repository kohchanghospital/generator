<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;

class ChecklistController extends Controller

{

    // หน้าแสดงตาราง
    public function index()
    {
        $lists = Checklist::all();
        return view('checklist.index', compact('lists'));
    }

    // หน้าเพิ่มข้อมูล
    public function create()
    {
        return view('checklist.create');
    }

    // บันทึกข้อมูล
    public function store(Request $request)
    {
        try {
            $request->validate([
                'checklist_name' => 'required|string|max:255',
                'status' => 'required'
            ]);

            Checklist::create([
                'checklist_name' => $request->checklist_name,
                'status' => $request->status,
            ]);

            return redirect()
                ->route('checklist.index')
                ->with([
                    'toast_type' => 'create',
                    'toast_message' => 'เพิ่มรายการตรวจเช็คเรียบร้อยแล้ว'
                ]);

        } catch (\Exception $e) {

            return redirect()
                ->route('checklist.index')
                ->with([
                    'toast_type' => 'error',
                    'toast_message' => 'ไม่สามารถเพิ่มรายการตรวจเช็คได้'
                ]);
        }
    }


    // ดูรายละเอียด
    public function show($id)
    {
        $item = Checklist::findOrFail($id);
        return view('checklist.show', compact('item'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'checklist_name' => 'required|string|max:255',
                'status' => 'required'
            ]);

            $item = Checklist::findOrFail($id);
            $item->update([
                'checklist_name' => $request->checklist_name,
                'status' => $request->status,
            ]);

            return redirect()
                ->route('checklist.index')
                ->with([
                    'toast_type' => 'update',
                    'toast_message' => 'บันทึกรายการตรวจเช็คเรียบร้อยแล้ว'
                ]);


        } catch (\Exception $e) {

            return redirect()
                ->route('checklist.index')
                ->with([
                    'toast_type' => 'error',
                    'toast_message' => 'ไม่สามารถบันทึกข้อมูลได้'
                ]);

        }
    }

    public function destroy($id)
    {
        try {
            Checklist::findOrFail($id)->delete();

            return redirect()
                ->route('checklist.index')
                ->with([
                    'toast_type' => 'delete',
                    'toast_message' => 'ลบรายการตรวจเช็คเรียบร้อยแล้ว'
                ]);

        } catch (\Exception $e) {

            return redirect()
                ->route('checklist.index')
                ->with([
                    'toast_type' => 'error',
                    'toast_message' => 'ไม่สามารถลบรายการตรวจเช็คได้'
                ]);
        }
    }


}