<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agency;
use App\Models\AgencyRoute;
use App\Models\Airport;
use Illuminate\Support\Facades\DB;

class AgencyRouteSeeder extends Seeder {
    public function run(): void {
        // پیدا کردن آژانس سپهرهاب
        $agency = Agency::where('name_en', 'Sepehrhub')->first();

        if (!$agency) {
            $this->command->warn('Agency Sepehrhub not found. Skipping route seeding.');
            return;
        }

        // دریافت لیست فرودگاه‌ها
        $airports = Airport::where('domestic_flight', 1)->pluck('id')->toArray();

        $allDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

        $routes = [];

        foreach ($airports as $origin) {
            foreach ($airports as $destination) {
                if ($origin == $destination) continue; // جلوگیری از مسیر یکسان (مثلاً THR -> THR)

                $routes[] = [
                    'agency_id' => $agency->id,
                    'origin_id' => $origin,
                    'destination_id' => $destination,
                    'days_available' => json_encode($allDays),
                    'priority' => 'medium',
                    'last_updated' => now(),
                    'auto_generated' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // درج همه مسیرها در دیتابیس
        DB::table('agency_routes')->insert($routes);

        $this->command->info("All flight routes for Sepehrhub have been added.");
    }
}
