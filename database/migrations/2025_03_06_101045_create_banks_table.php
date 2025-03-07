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
            $table->string('name_fa'); // نام بانک به فارسی
            $table->string('name_en'); // نام بانک به انگلیسی (در صورت نیاز برای API)
            $table->string('code')->unique(); // کد اختصاصی بانک (مثلاً Mellat, Tejarat)
            $table->string('swift_code')->nullable(); // کد سویفت (در صورت نیاز برای تراکنش‌های بین‌المللی)
            $table->string('logo')->nullable(); // آدرس لوگوی بانک (اختیاری)
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
