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
        Schema::create('bike_circuit', function (Blueprint $table) {
            $table->foreignId('bike_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('circuit_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->time('lap_time')->nullable();
            $table->date('record_date')->nullable();
            $table->primary(['bike_id', 'circuit_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bike_circuit', function (Blueprint $table) {
            $table->dropForeign(['bike_id']);
            $table->dropForeign(['circuit_id']);
        });
        
        Schema::dropIfExists('bike_circuit');
    }
};
