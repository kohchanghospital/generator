<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Generator;

class GeneratorController extends Controller

{

    // หน้าแสดงตาราง
    public function index()
    {
        $lists = Generator::all();
        return view('generator.index', compact('lists'));
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
                'status' => 'required',
            ]);

            Generator::create([
                'machine_code' => $request->machine_code,
                'asset_no' => $request->asset_no,
                'asset_name' => $request->asset_name,
                'brand' => $request->brand,
                'detail' => $request->detail,
                'status' => $request->status,
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
                'status' => 'required',
            ]);

            $item = Generator::findOrFail($id);
            $item->update([
                'machine_code' => $request->machine_code,
                'asset_no' => $request->asset_no,
                'asset_name' => $request->asset_name,
                'brand' => $request->brand,
                'detail' => $request->detail,
                'status' => $request->status,
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
            Generator::findOrFail($id)->delete();

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