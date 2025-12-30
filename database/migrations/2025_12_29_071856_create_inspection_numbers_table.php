<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inspection_numbers', function (Blueprint $table) {
            $table->id();

            $table->string('inspection_no')->unique();

            $table->foreignId('inspection_id')
                ->nullable()
                ->constrained('inspections')
                ->nullOnDelete();

            $table->enum('status', ['used', 'cancelled'])
                ->default('used');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_numbers');
    }
};
