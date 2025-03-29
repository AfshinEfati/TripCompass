<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('flights', function (Blueprint $table) {
            DB::statement('ALTER TABLE flights ADD INDEX flights_search_index (
        origin_id,
        destination_id,
        departure_time,
        arrival_time,
        airline_id,
        flight_number(10),
        class(5),
        cabin_type(10)
    )');
        });
    }

    public function down(): void
    {
        DB::statement('DROP INDEX flights_search_index ON flights');

    }
};
