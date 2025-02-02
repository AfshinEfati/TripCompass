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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('from_wallet_id')->nullable()->constrained('wallets')->onDelete('cascade');
            $table->foreignId('to_wallet_id')->nullable()->constrained('wallets')->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('cascade');
            $table->string('type')->comment('Transaction type: click, deposit, rent, etc.');
            $table->decimal('amount', 15, 2)->comment('Transaction amount in IRR');
            $table->json('details')->nullable()->comment('Additional details about the transaction');
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
