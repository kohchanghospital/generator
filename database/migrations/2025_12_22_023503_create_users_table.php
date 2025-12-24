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
            
            $table->string('status_name')->comment('ชื่อสถานะ');

            $table->timestamps();
        });
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
