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
        Schema::table('users', function(blueprint $table) {
            $table->date('birth_date')->default(now());
            $table->string('city', 256)->nullable();
            $table->string('phone', 16)->nullable();
            $table->string('display_name', 32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(blueprint $table) {
            $table->dropColumn('birth_date');
            $table->dropColumn('city');
            $table->dropColumn('phone');
            $table->dropColumn('display_name');
        });
    }
};
