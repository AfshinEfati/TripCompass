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
        Schema::create('agency_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('vendor'); // نام آژانس برای لود کلاس وندور
            $table->json('config'); // اطلاعات API مثل endpoint, username, password
            $table->integer('daily_request_limit')->default(-1); // تعداد درخواست روزانه (-1 یعنی نامحدود)
            $table->integer('min_update_interval')->default(30); // حداقل فاصله بین آپدیت‌ها (برحسب دقیقه)
            $table->boolean('no_route_restriction')->default(0); // اگر ۱ باشه، همه مسیرها رو ساپورت می‌کنه
            $table->boolean('is_active')->default(1); // اگر ۰ باشه، این سرویس غیرفعاله
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_services');
    }
};
