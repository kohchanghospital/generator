<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('check_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('status_code')
                ->comment('1=ผ่าน, 2=ไม่ผ่าน, 3=ไม่ได้ตรวจสอบ');

            $table->string('status_name', 50);
            $table->timestamps();
        });

        // เพิ่มข้อมูลสถานะเริ่มต้น
        DB::table('check_statuses')->insert([
            [
                'status_code' => 1,
                'status_name' => 'ผ่าน',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status_code' => 2,
                'status_name' => 'ไม่ผ่าน',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status_code' => 3,
                'status_name' => 'ไม่ได้ตรวจสอบ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('check_statuses');
    }
};
