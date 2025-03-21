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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // کاربر مربوطه
            $table->foreignId('gateway_id')->constrained()->onDelete('cascade'); // درگاه پرداخت
            $table->unsignedBigInteger('amount'); // مبلغ پرداخت
            $table->string('status')->default('pending'); // وضعیت: pending, success, failed
            $table->string('transaction_id')->nullable(); // کد تراکنش درگاه
            $table->text('failure_reason')->nullable(); // دلیل عدم موفقیت
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
