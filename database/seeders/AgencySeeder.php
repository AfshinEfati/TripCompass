<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agencies = [
            [
                'name' => 'Sepehrhub',
                'email' => 'test@example.com',
                'mobile' => '9150818762',
                'username' => 'Sepehrhub',
                'name_fa' => 'سپهرهاب',
                'vendor' => 'Sepehrhub',
                'endpoint' => 'https://SepehrApiTest.ir/api/Partners/Flight/Availability/V16/SearchByRouteAndDate',
                'username_api' => 'public',
                'password_api' => 'public',
                'is_active' => 0,
            ],
            [
                'name' => 'Marcopro',
                'email' => 'marco@example.com',
                'mobile' => '9357547462',
                'username' => 'Marcopro',
                'name_fa' => 'مارکوپرو',
                'vendor' => 'Marcopro',
                'endpoint' => 'https://api.shahansafar.ir/api/v2/ParsTrip/Flight/Search',
                'username_api' => null,
                'password_api' => null,
                'is_active' => 0,
            ],
            [
                'name' => 'Sainaticket',
                'email' => 'sainaticket@example.com',
                'mobile' => '9123456782',
                'username' => 'sinaticket',
                'name_fa' => 'سایناتیکت',
                'vendor' => 'Sainaticket',
                'endpoint' => 'https://charter.alibaba.ir/api/Partners/Flight/Availability/V16/SearchByRouteAndDate',
                'username_api' => 'public',
                'password_api' => 'public',
                'is_active' => 0,
            ], [
                'name' => 'Sepidparvaz',
                'email' => 'sepidparvaz@example.com',
                'mobile' => '9123456781',
                'username' => 'sepidparvaz',
                'name_fa' => 'سپید پرواز',
                'vendor' => 'Sepidparvaz',
                'endpoint' => 'https://sepidparvaz.ir/api/Partners/Flight/Availability/V16/SearchByRouteAndDate',
                'username_api' => 'public',
                'password_api' => 'public',
                'is_active' => 0,
            ], [
                'name' => 'rahbal',
                'email' => 'rahbal@example.com',
                'mobile' => '9123456780',
                'username' => 'rahbal',
                'name_fa' => 'رهبال',
                'vendor' => 'Rahbal',
                'endpoint' => 'https://sbook.rahbal.com/api/Partners/Flight/Availability/V16/SearchByRouteAndDate',
                'username_api' => 'public',
                'password_api' => 'public',
                'is_active' => 0,
            ], [
                'name' => 'mehraginseir',
                'email' => 'mehraginseir@example.com',
                'mobile' => '9123456784',
                'username' => 'mehraginseir',
                'name_fa' => 'mehraginseir',
                'vendor' => 'Mehraginseir',
                'endpoint' => 'https://mehraginseir.ir/api/Partners/Flight/Availability/V16/SearchByRouteAndDate',
                'username_api' => 'public',
                'password_api' => 'public',
                'is_active' => 0,
            ],

        ];

        foreach ($agencies as $agencyData) {
            $user = User::create([
                'name' => $agencyData['name'],
                'email' => $agencyData['email'],
                'mobile' => $agencyData['mobile'],
                'username' => $agencyData['username'],
                'avatar' => 'default.png',
                'is_admin' => 0,
                'is_active' => 1,
                'password' => bcrypt('password123'), // مقدار پیش‌فرض برای رمز عبور
                'token' => bcrypt('random_token'),
                'balance' => 0,
                'lock_balance' => 0,
            ]);

            $agency = Agency::create([
                'name_en' => $agencyData['name'],
                'name_fa' => $agencyData['name_fa'],
                'user_id' => $user->id,
                'is_active' => true,
            ]);

            $agency->services()->create([
                'agency_id' => $agency->id,
                'service_id' => 1,
                'vendor' => $agencyData['vendor'],
                'config' => [
                    'endpoint' => $agencyData['endpoint'],
                    'username' => $agencyData['username_api'],
                    'password' => $agencyData['password_api'],
                ],
                'daily_request_limit' => -1,
                'min_update_interval' => 30,
                'no_route_restriction' => 0,
                'is_active' => $agencyData['is_active'],
            ]);
        }
    }
}
