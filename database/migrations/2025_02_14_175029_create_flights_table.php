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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->uuid('flight_key')->unique()->default(Str::uuid());
            $table->foreignId('origin_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('destination_id')->constrained('airports')->onDelete('cascade');
            $table->timestamp('departure_time');
            $table->timestamp('arrival_time');
            $table->foreignId('airline_id')->constrained('airlines')->onDelete('cascade');
            $table->string('flight_number');
            $table->foreignId('agency_id')->constrained('agencies')->onDelete('cascade');
            $table->json('price_details');
            $table->integer('capacity');
            $table->string('cabin_type')->default('Economy');
            $table->string('class')->default('Y');
            $table->boolean('is_charter')->default(false);
            $table->json('baggage')->nullable();
            $table->string('currency')->default('IRR');
            $table->string('call_back')->nullable();
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
