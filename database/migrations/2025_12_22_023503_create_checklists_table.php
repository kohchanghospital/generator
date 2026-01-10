<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();

            $table->string('checklist_name')
                ->comment('ชื่อรายการ checklist');

            $table->boolean('is_active')
                ->default(true)
                ->comment('1=เปิดใช้งาน, 0=ปิดใช้งาน');

            $table->timestamps();
        });

        // ===== insert ค่าเริ่มต้น (ตามรูปที่ให้มา) =====
        DB::table('checklists')->insert([
            ['checklist_name' => 'น้ำมันเชื้อเพลิง (400ลิตร)', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'สภาพสายไฟ ชำรุด', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'ทำความสะอาดโรงไฟฟ้าควบคุม', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'เบรกเกอร์ ควบคุมไฟ', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'สภาพสายไฟ ชำรุด', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'น้ำมันเครื่อง', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'น้ำหม้อน้ำ', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'ทดสอบการเดินเครื่อง 10 นาที', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'ระบบสตาร์ทแบบแมนนวล', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'ความเร็วรอบ', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'แรงดันไฟฟ้า', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'สภาพแผงควบคุม', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['checklist_name' => 'น้ำกลั่นแบตเตอรี่', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklists');
    }
};
