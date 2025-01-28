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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable'); // Polymorphic relation (type and ID)
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->string('plate_number')->nullable()->comment('Plate number of the address');
            $table->string('floor_number')->nullable()->comment('Floor number of the address');
            $table->text('address_line_1')->nullable()->comment('Main address line');
            $table->text('address_line_2')->nullable()->comment('Secondary address line');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
