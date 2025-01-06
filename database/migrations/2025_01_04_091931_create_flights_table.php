<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained('agencies');
            $table->foreignId('origin_id')->constrained('airports');
            $table->foreignId('destination_id')->constrained('airports');
            $table->timestamp('departure_date')->nullable();
            $table->timestamp('return_date')->nullable();
            $table->enum('flight_type', ['trip', 'round'])->default('trip');
            $table->json('flight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
