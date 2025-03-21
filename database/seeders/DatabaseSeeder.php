<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(BankSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(AirportSeeder::class);
        $this->call(AirlineSeeder::class);
        $this->call(AgencySeeder::class);
        $this->call(AgencyRouteSeeder::class);
        $this->call(GateWaySeeder::class);
    }
}
