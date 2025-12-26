<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            
            $table->string('checklist_name')->comment('ชื่อ checklist');
            $table->string('status')->nullable()->comment('สถานะ');

            $table->timestamps();
        });

        Schema::create('status', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedTinyInteger('status_code')->comment('1=ผ่าน, 2=ไม่ผ่าน, 3=ไม่ได้ตรวจสอบ');
            $table->string('status_name')->comment('ชื่อสถานะ');

            $table->timestamps();
        });

        DB::table('status')->insert([
            [
                'status_code' => 1,
                'status_name' => 'เปิดใช้งาน',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status_code' => 2,
                'status_name' => 'ปิดใช้งาน',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist');
        Schema::dropIfExists('status');
    }
};
