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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('payment_id')->nullable()->constrained('payments');
            $table->foreignId('wallet_id')->nullable()->constrained('agency_wallets');
            $table->foreignId('agency_id')->nullable()->constrained('agencies');
            $table->unsignedTinyInteger('amount');
            $table->enum('type', ['withdraw', 'deposit']);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
