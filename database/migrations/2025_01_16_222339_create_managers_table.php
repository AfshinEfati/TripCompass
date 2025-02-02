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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained()->onDelete('cascade');
            $table->string('name_en')->comment('Manager first name in English');
            $table->string('family_en')->comment('Manager last name in English');
            $table->string('name_fa')->nullable()->comment('Manager first name in Persian');
            $table->string('family_fa')->nullable()->comment('Manager last name in Persian');
            $table->string('mobile')->unique()->comment('Manager mobile number');
            $table->string('national_id')->unique()->comment('Unique national ID');
            $table->enum('gender', ['male', 'female'])->nullable()->comment('Manager gender');
            $table->date('birthday')->nullable()->comment('Manager date of birth');
            $table->text('address')->nullable()->comment('Manager physical address');
            $table->string('position')->nullable()->comment('Manager job position or title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
};
