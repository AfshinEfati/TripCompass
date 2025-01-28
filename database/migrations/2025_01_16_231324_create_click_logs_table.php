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
        Schema::create('click_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->comment('Clicked product ID');
            $table->string('product_type')->comment('Type of product: flight, hotel, etc.');
            $table->string('ip_address')->comment('User IP address');
            $table->timestamp('clicked_at')->comment('Timestamp of the click');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('click_logs');
    }
};
