<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inspection_checklists', function (Blueprint $table) {
            $table->id();

            // ใบตรวจ
            $table->foreignId('inspection_id')
                ->constrained()
                ->cascadeOnDelete();

            // checklist
            $table->foreignId('checklist_id')
                ->constrained()
                ->cascadeOnDelete();

            // สถานะ: 1 ผ่าน, 2 ไม่ผ่าน, 3 ไม่ได้ตรวจ
            $table->unsignedTinyInteger('status')
                ->comment('1=ผ่าน, 2=ไม่ผ่าน, 3=ไม่ได้ตรวจ');

            // หมายเหตุราย checklist (ถ้ามี)
            $table->text('remark')->nullable();

            $table->timestamps();

            // กัน checklist ซ้ำในใบตรวจเดียว
            $table->unique(['inspection_id', 'checklist_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_checklists');
    }
};
