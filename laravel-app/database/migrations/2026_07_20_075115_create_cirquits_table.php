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
    { //'name', 'location', 'country_id', 'length', 'turns', 'capacity', 'image', 'description'
        Schema::create('circuits', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256)->unique();
            $table->string('country_id', 2);
            $table->string('location', 512)->nullable();
            $table->decimal('length', 6, 3);
            $table->unsignedSmallInteger('turns')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->string('image', 512)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::table('circuits', function (Blueprint $table) {
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circuits');
    }
};
