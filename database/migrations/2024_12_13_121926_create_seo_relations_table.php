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
        Schema::create('seo_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seo_id')->constrained('seos');
            $table->unsignedBigInteger('model_id')->index();
            $table->string('model_type');
            $table->string('relation_type',50);
            $table->index(['model_type', 'model_id','seo_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_relations');
    }
};
