<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agency;
use App\Models\AgencyRoute;
use App\Models\Airport;
use Illuminate\Support\Facades\DB;

class AgencyRouteSeeder extends Seeder
{
    public function run(): void
    {
        $agencies = Agency::all();

        $airports = Airport::where('domestic_flight', 1)->pluck('id')->toArray();

        $allDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

        $routes = [];
        foreach ($agencies as $agency) {
            foreach ($airports as $origin) {
                foreach ($airports as $destination) {
                    if ($origin == $destination) continue;
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
        }

        DB::table('agency_routes')->insert($routes);

        $this->command->info("All flight routes for Sepehrhub have been added.");
    }
}
