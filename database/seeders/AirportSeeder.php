<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airports = [
            ['name_en' => 'Imam Khomeini International Airport', 'name_fa' => 'فرودگاه بین‌المللی امام خمینی', 'iata_code' => 'IKA', 'icao_code' => 'OIIE', 'city_id' => 1, 'is_popular' => true, 'foreign_flight' => true, 'domestic_flight' => false],
            ['name_en' => 'Mehrabad Airport', 'name_fa' => 'فرودگاه مهرآباد', 'iata_code' => 'THR', 'icao_code' => 'OIII', 'city_id' => 1, 'is_popular' => true, 'foreign_flight' => false, 'domestic_flight' => true],
            ['name_en' => 'Shahid Hasheminejad International Airport', 'name_fa' => 'فرودگاه بین‌المللی شهید هاشمی‌نژاد', 'iata_code' => 'MHD', 'icao_code' => 'OIMM', 'city_id' => 2, 'is_popular' => true, 'foreign_flight' => true, 'domestic_flight' => true],
            ['name_en' => 'Isfahan International Airport', 'name_fa' => 'فرودگاه بین‌المللی اصفهان', 'iata_code' => 'IFN', 'icao_code' => 'OIFM', 'city_id' => 3, 'is_popular' => true, 'foreign_flight' => true, 'domestic_flight' => true],
            ['name_en' => 'Payam Airport', 'name_fa' => 'فرودگاه پیام', 'iata_code' => 'PYK', 'icao_code' => 'IBPY', 'city_id' => 4, 'is_popular' => false, 'foreign_flight' => false, 'domestic_flight' => true],
            ['name_en' => 'Shiraz International Airport', 'name_fa' => 'فرودگاه بین‌المللی شیراز', 'iata_code' => 'SYZ', 'icao_code' => 'OISS', 'city_id' => 5, 'is_popular' => true, 'foreign_flight' => true, 'domestic_flight' => true],
            ['name_en' => 'Tabriz International Airport', 'name_fa' => 'فرودگاه بین‌المللی تبریز', 'iata_code' => 'TBZ', 'icao_code' => 'OITT', 'city_id' => 6, 'is_popular' => true, 'foreign_flight' => true, 'domestic_flight' => true],
            ['name_en' => 'Qom Airport', 'name_fa' => 'فرودگاه قم', 'iata_code' => 'N/A', 'icao_code' => 'N/A', 'city_id' => 7, 'is_popular' => false, 'foreign_flight' => false, 'domestic_flight' => true],
            ['name_en' => 'Ahvaz International Airport', 'name_fa' => 'فرودگاه بین‌المللی اهواز', 'iata_code' => 'AWZ', 'icao_code' => 'OIAW', 'city_id' => 8, 'is_popular' => true, 'foreign_flight' => true, 'domestic_flight' => true],
            ['name_en' => 'Shahid Ashrafi Esfahani Airport', 'name_fa' => 'فرودگاه شهید اشرفی اصفهانی', 'iata_code' => 'KSH', 'icao_code' => 'OICC', 'city_id' => 9, 'is_popular' => false, 'foreign_flight' => true, 'domestic_flight' => true],
            ['name_en' => 'Urmia Airport', 'name_fa' => 'فرودگاه ارومیه', 'iata_code' => 'OMH', 'icao_code' => 'OITR', 'city_id' => 10, 'is_popular' => false, 'foreign_flight' => true, 'domestic_flight' => true],
        ];

        foreach ($airports as $airport) {
            Airport::query()->create($airport);
        }
    }
}
