<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('sensor_data_iot', function (Blueprint $table) {
        $table->id();
        $table->float('temperature')->nullable();
        $table->float('tds')->nullable();
        $table->float('ph')->nullable();
        $table->timestamp('timestamp')->useCurrent();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};
