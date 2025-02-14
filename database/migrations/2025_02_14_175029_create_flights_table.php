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
            $table->uuid('flight_key')->unique()->default(Str::uuid()); // کلید یکتا
            $table->foreignId('origin_id')->constrained('airports')->onDelete('cascade'); // مبدا
            $table->foreignId('destination_id')->constrained('airports')->onDelete('cascade'); // مقصد
            $table->timestamp('departure_time'); // زمان حرکت
            $table->timestamp('arrival_time'); // زمان رسیدن
            $table->foreignId('airline_id')->constrained('airlines')->onDelete('cascade'); // شرکت هواپیمایی
            $table->string('flight_number'); // شماره پرواز
            $table->foreignId('agency_id')->constrained('agencies')->onDelete('cascade'); // آژانس ارائه‌دهنده
            $table->json('price_details'); // اطلاعات قیمت (بزرگسال، کودک، نوزاد)
            $table->integer('capacity'); // تعداد صندلی‌های باقی‌مانده
            $table->string('cabin_type')->default('Economy'); // کلاس پروازی
            $table->string('class')->default('Y'); // کلاس پروازی
            $table->boolean('is_charter')->default(false); // پرواز چارتر
            $table->json('baggage')->nullable(); // اطلاعات بار مجاز
            $table->string('currency')->default('IRR'); // واحد پول
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
