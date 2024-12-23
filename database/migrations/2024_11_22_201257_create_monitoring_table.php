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
        Schema::create('monitoring', function (Blueprint $table) {
            $table->id();
            $table->float('temperature')->nullable(); // Kolom suhu air
            $table->float('turbidity')->nullable();   // Kolom kekeruhan air (TDS)
            $table->float('ph')->nullable();          // Kolom pH air
            $table->boolean('notification')->default(false); // Status notifikasi
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring');
    }
};
