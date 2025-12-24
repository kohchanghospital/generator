<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('generators', function (Blueprint $table) {
            $table->id();

            $table->string('machine_code')->comment('รหัสเครื่อง');
            $table->string('asset_no')->comment('เลขครุภัณฑ์');
            $table->string('asset_name')->comment('ชื่อครุภัณฑ์ / ชื่อเครื่อง');
            $table->string('brand')->nullable()->comment('ยี่ห้อ');
            $table->text('detail')->nullable()->comment('รายละเอียด');
            $table->string('status')->nullable()->comment('สถานะ');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('generators');
    }
};
