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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->unique();
            $table->string('name_fa')->nullable();
            $table->string('base_url');
            $table->enum('contract_type', ['percentage', 'fixed'])->default('fixed');
            $table->integer('commission_rate')->default(0);
            $table->unsignedBigInteger('fixed_rate')->default(2000)->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
