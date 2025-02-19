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
        Schema::create('agency_routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained()->onDelete('cascade');
            $table->foreignId('origin_id')->constrained('airports')->onDelete('cascade'); // مبدأ
            $table->foreignId('destination_id')->constrained('airports')->onDelete('cascade'); // مقصد
            $table->json('days_available'); // روزهای مجاز (Monday, Tuesday, ...)
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // اولویت مسیر
            $table->timestamp('last_updated')->nullable(); // زمان آخرین آپدیت مسیر
            $table->boolean('auto_generated')->default(0); // مسیر دستی یا خودکار ساخته‌شده
            $table->timestamps();
            $table->unique(['agency_id', 'origin_id', 'destination_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_routes');
    }
};
