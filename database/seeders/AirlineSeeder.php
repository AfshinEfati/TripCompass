<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airlines = [
            ['name_en' => 'Iran Air', 'name_fa' => 'ایران ایر', 'iata_code' => 'IR', 'icao_code' => 'IRA', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/iran_air.webp'],
            ['name_en' => 'Mahan Air', 'name_fa' => 'ماهان ایر', 'iata_code' => 'W5', 'icao_code' => 'IRM', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/mahan_air.webp'],
            ['name_en' => 'Aseman Airlines', 'name_fa' => 'آسمان ایر', 'iata_code' => 'EP', 'icao_code' => 'IRC', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/aseman_air.webp'],
            ['name_en' => 'Caspian Airlines', 'name_fa' => 'کاسپین ایر', 'iata_code' => 'IV', 'icao_code' => 'CPN', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/caspian_air.webp'],
            ['name_en' => 'ATA Airlines', 'name_fa' => 'اتا ایر', 'iata_code' => 'I3', 'icao_code' => 'TBZ', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/ata_air.webp'],
            ['name_en' => 'Kish Air', 'name_fa' => 'کیش ایر', 'iata_code' => 'Y9', 'icao_code' => 'IRK', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/kish_air.webp'],
            ['name_en' => 'Qeshm Air', 'name_fa' => 'قشم ایر', 'iata_code' => 'QB', 'icao_code' => 'IRQ', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/qeshm_air.webp'],
            ['name_en' => 'Taban Air', 'name_fa' => 'تابان ایر', 'iata_code' => 'HH', 'icao_code' => 'TBN', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/taban_air.webp'],
            ['name_en' => 'Varesh Airlines', 'name_fa' => 'وارش ایر', 'iata_code' => 'VR', 'icao_code' => 'VRH', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/varesh_air.webp'],
            ['name_en' => 'Zagros Airlines', 'name_fa' => 'زاگرس ایر', 'iata_code' => 'IZ', 'icao_code' => 'IZG', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/zagros_air.webp'],
            ['name_en' => 'Sepehran Airlines', 'name_fa' => 'سپهران ایر', 'iata_code' => 'IS', 'icao_code' => 'SPN', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/sepehran_air.webp'],
            ['name_en' => 'Karun Airlines', 'name_fa' => 'کارون ایر', 'iata_code' => 'NV', 'icao_code' => 'KRN', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/karun_air.webp'],
            ['name_en' => 'Pouya Air', 'name_fa' => 'پویا ایر', 'iata_code' => 'PYA', 'icao_code' => 'PYA', 'country_id' => 1, 'logo_url' => 'storage/app/public/images/airlines/pouya_air.webp'],
        ];

        foreach ($airlines as $airline) {
            Airline::create($airline);
        }
    }
}
