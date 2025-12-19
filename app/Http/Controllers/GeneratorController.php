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

}