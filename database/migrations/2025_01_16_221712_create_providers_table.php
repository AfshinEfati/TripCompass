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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name_en', 150)->comment('en name of the provider');
            $table->string('name_fa', 150)->nullable()->comment('persian name of the provider');
            $table->string('class', 60)->nullable()->comment('en name of the provider');
            $table->string('email')->unique()->comment('email of the provider');
            $table->string('website')->nullable()->comment('website of the provider');
            $table->string('phone')->nullable()->comment('phone of the provider');
            $table->string('password');
            $table->string('api_key')->nullable()->comment('api key of the provider');
            $table->tinyInteger('signup_step')->default(1)->comment('Tracks the signup step');
            $table->string('status')->default('pending')->comment('Account status: pending, active, suspended');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
