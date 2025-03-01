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
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable()->unique();
            $table->string('name_fa')->nullable()->unique();
            $table->string('iata_code', 3)->nullable()->unique();
            $table->string('icao_code', 4)->nullable()->unique();
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('foreign_flight')->default(false);
            $table->boolean('domestic_flight')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
