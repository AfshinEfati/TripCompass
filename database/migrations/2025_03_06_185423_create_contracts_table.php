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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('contract_type', ['CPC', 'CPA', 'subscription'])->default('CPC')->comment('CPC: Cost Per Click, CPA: Cost Per Action, subscription: Monthly Subscription');
            $table->string('license_number')->nullable();
            $table->string('company_registration_number')->nullable();
            $table->string('national_id')->nullable();
            $table->string('economic_code')->nullable();
            $table->string('contact_person');
            $table->string('contact_national_id');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->string('bank_account')->nullable();
            $table->string('bank_shaba')->nullable();
            $table->foreignId('bank_id')->constrained('banks')->onDelete('set null');
            $table->enum('status', ['pending', 'reviewing', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
