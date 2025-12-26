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

        Schema::create('check_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('electrical_number');
            $table->date('check_date');
            $table->time('check_time');
            $table->string('created_by');
            $table->text('remark')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generator_checklists');
    }
};
