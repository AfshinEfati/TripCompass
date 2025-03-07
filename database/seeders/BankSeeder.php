<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            ['name_fa' => 'بانک ملت', 'name_en' => 'Mellat', 'code' => 'Mellat', 'swift_code' => 'BKMTIRXXXX', 'logo' => 'banks/mellat.png'],
            ['name_fa' => 'بانک تجارت', 'name_en' => 'Tejarat', 'code' => 'Tejarat', 'swift_code' => 'BJTIIRXXXX', 'logo' => 'banks/tejarat.png'],
            ['name_fa' => 'بانک ملی', 'name_en' => 'Melli', 'code' => 'Melli', 'swift_code' => 'BMELIRXXXX', 'logo' => 'banks/melli.png'],
            ['name_fa' => 'بانک سپه', 'name_en' => 'Sepah', 'code' => 'Sepah', 'swift_code' => 'SEPBIRXXXX', 'logo' => 'banks/sepah.png'],
            ['name_fa' => 'بانک پارسیان', 'name_en' => 'Parsian', 'code' => 'Parsian', 'swift_code' => 'PARSIIRXXXX', 'logo' => 'banks/parsian.png'],
            ['name_fa' => 'بانک سامان', 'name_en' => 'Saman', 'code' => 'Saman', 'swift_code' => 'SABCIRXXXX', 'logo' => 'banks/saman.png'],
            ['name_fa' => 'بانک پاسارگاد', 'name_en' => 'Pasargad', 'code' => 'Pasargad', 'swift_code' => 'BKBPIRXXXX', 'logo' => 'banks/pasargad.png'],
            ['name_fa' => 'بانک کشاورزی', 'name_en' => 'Keshavarzi', 'code' => 'Keshavarzi', 'swift_code' => 'AGIBIRXXXX', 'logo' => 'banks/keshavarzi.png'],
            ['name_fa' => 'بانک صادرات', 'name_en' => 'Saderat', 'code' => 'Saderat', 'swift_code' => 'BSIRIRXXXX', 'logo' => 'banks/saderat.png'],
            ['name_fa' => 'بانک رفاه', 'name_en' => 'Refah', 'code' => 'Refah', 'swift_code' => 'REFAIRXXXX', 'logo' => 'banks/refah.png'],
        ];

        DB::table('banks')->insert($banks);
    }
}
