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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->comment('Bank name in English');
            $table->string('name_fa')->comment('Bank name in Persian');
            $table->string('class')->comment('Bank class');
            $table->json('details')->nullable()->comment('Bank additional details in JSON format');
            $table->boolean('status')->default(true)->comment('Bank status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
