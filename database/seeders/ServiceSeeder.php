<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name_en' => 'Flight', 'name_fa' => 'پرواز'],
            ['name_en' => 'International_flight', 'name_fa' => 'پرواز خارجی'],
            ['name_en' => 'Hotel', 'name_fa' => 'هتل'],
            ['name_en' => 'International_hotel', 'name_fa' => 'هتل خارجی'],
            ['name_en' => 'Train', 'name_fa' => 'قطار'],
        ];
        Service::insert($services);
        $cityService = [
            ['city_id' => 1, 'service_id' => 1, 'is_active' => true],
            ['city_id' => 1, 'service_id' => 2, 'is_active' => true],
            ['city_id' => 2, 'service_id' => 1, 'is_active' => true],
            ['city_id' => 2, 'service_id' => 3, 'is_active' => true],
            ['city_id' => 3, 'service_id' => 2, 'is_active' => true],
            ['city_id' => 3, 'service_id' => 3, 'is_active' => true],
        ];
        foreach ($cityService as $entry) {
            DB::table('city_service')->insert($entry);
        }
    }
}
