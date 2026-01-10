<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;

class ChecklistController extends Controller

{

    // หน้าแสดงตาราง
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 20); // ค่าเริ่มต้น 20

        $lists = Checklist::orderBy('id')
            ->paginate($perPage)
            ->withQueryString(); // จำค่า per_page เวลาเปลี่ยนหน้า

        return view('checklist.index', compact('lists', 'perPage'));
    }


    // บันทึกข้อมูล
    public function store(Request $request)
    {
        try {
            $request->validate([
                'checklist_name' => 'required|string|max:255',
                'is_active' => 'required'
            ]);

            Checklist::create([
                'checklist_name' => $request->checklist_name,
                'is_active' => $request->is_active,
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

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'checklist_name' => 'required|string|max:255',
                'is_active' => 'required'
            ]);

            $item = Checklist::findOrFail($id);
            $item->update([
                'checklist_name' => $request->checklist_name,
                'is_active' => $request->is_active,
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
