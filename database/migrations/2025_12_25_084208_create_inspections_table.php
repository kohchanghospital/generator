<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();

            // เลขที่ใบตรวจ (ระบบ generate)
            $table->string('inspection_no')->unique();

            // วันที่ / เวลา ตรวจ
            $table->date('inspection_date');
            $table->time('inspection_time');

            // เครื่องปั่นไฟ
            $table->foreignId('generator_id')
                ->constrained('generators')
                ->cascadeOnDelete();

            // ผู้ตรวจ
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // หมายเหตุ
            $table->text('remark')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
