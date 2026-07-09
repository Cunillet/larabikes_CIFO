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
        Schema::table('bikes', function(blueprint $table) {
            $table->string('bike_plate')->unique()->after('registered')->nullable();
            $table->string('color', 32)->after('model')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bikes', function(Blueprint $table) {
            $table->dropColumn(('bike_plate'));
            $table->dropColumn(('color'));
        });
    }
};
