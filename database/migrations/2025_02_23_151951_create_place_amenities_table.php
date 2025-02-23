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
        Schema::create('place_amenities', function (Blueprint $table) {
            $table->foreignId('place_id')->references('id')->on('place_types')->onDelete('cascade');
            $table->foreignId('amenity_id')->references('id')->on('amenities')->onDelete('cascade');
            $table->boolean('availability');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_amenities');
    }
};
