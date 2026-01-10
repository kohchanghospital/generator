<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Generator;

class GeneratorController extends Controller

{

    // หน้าแสดงตาราง
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 20); // ค่าเริ่มต้น 20

        $lists = Generator::withCount('inspections')
            ->orderBy('id')
            ->paginate($perPage)
            ->withQueryString(); // จำค่า per_page เวลาเปลี่ยนหน้า

        return view('generator.index', compact('lists', 'perPage'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'machine_code' => 'required|string|max:255',
                'asset_no' => 'required|string|max:255',
                'asset_name' => 'required|string|max:255',
                'brand' => 'required|string|max:255',
                'detail' => 'nullable|string',
                'is_active' => 'required',
            ]);

            Generator::create([
                'machine_code' => $request->machine_code,
                'asset_no' => $request->asset_no,
                'asset_name' => $request->asset_name,
                'brand' => $request->brand,
                'detail' => $request->detail,
                'is_active' => $request->is_active,
            ]);

            return redirect()
                ->route('generator.index')
                ->with([
                    'toast_type' => 'create',
                    'toast_message' => 'เพิ่มรายการเครื่องปั่นไฟเรียบร้อยแล้ว'
                ]);
        } catch (\Exception $e) {

            return redirect()
                ->route('generator.index')
                ->with([
                    'toast_type' => 'error',
                    'toast_message' => 'ไม่สามารถเพิ่มรายการเครื่องปั่นไฟได้'
                ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'machine_code' => 'required|string|max:255',
                'asset_no' => 'required|string|max:255',
                'asset_name' => 'required|string|max:255',
                'brand' => 'required|string|max:255',
                'detail' => 'nullable|string',
                'is_active' => 'required',
            ]);

            $item = Generator::findOrFail($id);
            $item->update([
                'machine_code' => $request->machine_code,
                'asset_no' => $request->asset_no,
                'asset_name' => $request->asset_name,
                'brand' => $request->brand,
                'detail' => $request->detail,
                'is_active' => $request->is_active,
            ]);

            return redirect()
                ->route('generator.index')
                ->with([
                    'toast_type' => 'update',
                    'toast_message' => 'บันทึกรายการเครื่องปั่นไฟเรียบร้อยแล้ว'
                ]);
        } catch (\Exception $e) {

            return redirect()
                ->route('generator.index')
                ->with([
                    'toast_type' => 'error',
                    'toast_message' => 'ไม่สามารถบันทึกรายการเครื่องปั่นไฟได้'
                ]);
        }
    }

    public function destroy($id)
    {
        try {
            $generator = Generator::withCount('inspections')
                ->findOrFail($id);

            // ❌ ถ้ามีถูกใช้งานในใบ inspection
            if ($generator->inspections_count > 0) {
                return redirect()
                    ->route('generator.index')
                    ->with([
                        'toast_type' => 'error',
                        'toast_message' => 'ไม่สามารถลบได้ เนื่องจากถูกใช้งานในใบตรวจ'
                    ]);
            }

            $generator->delete();

            return redirect()
                ->route('generator.index')
                ->with([
                    'toast_type' => 'delete',
                    'toast_message' => 'ลบรายการเครื่องปั่นไฟเรียบร้อยแล้ว'
                ]);
        } catch (\Exception $e) {

            return redirect()
                ->route('generator.index')
                ->with([
                    'toast_type' => 'error',
                    'toast_message' => 'ไม่สามารถลบรายการเครื่องปั่นไฟได้'
                ]);
        }
    }


    // ดูรายละเอียด
    public function show($id)
    {
        $item = Generator::findOrFail($id);
        return view('generator.show', compact('item'));
    }

    // ดูรายละเอียด
    public function edit($id)
    {
        $item = Generator::findOrFail($id);
        return view('generator.edit', compact('item'));
    }
}
