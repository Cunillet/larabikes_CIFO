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
        Schema::create('contact_data', function(Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('phone', 16)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('country_id', 2)->nullable();
            $table->timestamps();
        });
        Schema::table('contact_data', function (Blueprint $table) {
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_data', function (Blueprint $table) {
            $table->dropForeign('contact_data_user_id_foreign');
            $table->dropForeign('contact_data_country_id_foreign');
        });
        Schema::dropIfExists('contact_data');
        Schema::table('contact_data', function (Blueprint $table) {
            $table->string('phone', 16)->nullable();
            $table->string('city', 256)->nullable();
        });
    }
};
