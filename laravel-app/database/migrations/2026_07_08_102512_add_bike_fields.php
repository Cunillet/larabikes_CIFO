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
            $table->text('description')->nullable();
            $table->date('buy_date')->default(now());
            $table->integer('horsepower')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bikes', function(Blueprint $table) {
            $table->dropColumn(('description'));
            $table->dropColumn(('buy_date'));
            $table->dropColumn('horsepower');
        });
    }
};
