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
        Schema::create('click_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('click_rate_type_id')->nullable();
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->string('contract_type')->nullable();
            $table->decimal('rate', 10, 2);
            $table->timestamps();

            $table->foreign('click_rate_type_id')->references('id')->on('click_rate_types')->onDelete('set null');
            $table->unique(['service_id', 'click_rate_type_id', 'agency_id', 'contract_type'], 'click_rates_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('click_rates');
    }
};
