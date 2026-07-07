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
        Schema::create('bikes', function(Blueprint $table) {
            $table->id();
            $table->string('brand', 255);
            $table->string('model', 255);
            $table->integer('kms')->default(0);
            $table->float('price')->default(0);
            $table->boolean('registered')->default(false);
            $table->timestamps(); // refers to params: created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bikes');
    }
};
