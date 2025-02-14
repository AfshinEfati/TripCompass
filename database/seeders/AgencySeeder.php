<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Sepehrhub',
            'email' => 'test@example.com',
            'mobile' => '9150818762',
            'username' => 'Sepehrhub',
            'avatar' => 'default.png',
            'is_admin' => 0,
            'is_active' => 1,
            'password' => '$2y$10$3',
            'token' => '$2y$10$3',
            'balance' => 0,
            'lock_balance' => 0,
        ]);
        $data = [
            'name_en' => 'Sepehrhub',
            'name_fa' => 'سپهرهاب',
            'user_id' => $user->id,
            'is_active' => true,
        ];
        $agency = Agency::create($data);
        $agencyService = [
            'agency_id' => $agency->id,
            'service_id'=>1,
            'vendor'=> 'Sepehrhub',
            'config' => [
                'endpoint' => 'https://SepehrApiTest.ir/api/Partners/Flight/Availability/V16/SearchByRouteAndDate',
                'username' => 'public',
                'password' => 'public',
            ],
            'daily_request_limit' => -1,
            'min_update_interval' => 30,
            'no_route_restriction' => 0,
            'is_active' => 1,

        ];
        $agency->services()->create($agencyService);

    }
}
