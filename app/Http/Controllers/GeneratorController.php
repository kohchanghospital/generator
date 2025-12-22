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

    // ดูรายละเอียด
    public function show($id)
    {
        $item = Generator::findOrFail($id);
        return view('checklist.show', compact('item'));
    }

    // ดูรายละเอียด
    public function edit($id)
    {
        $item = Generator::findOrFail($id);
        return view('checklist.edit', compact('item'));
    }

}