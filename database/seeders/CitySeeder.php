<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name_en' => 'Tehran', 'name_fa' => 'تهران', 'state_id' => 1], // تهران
            ['name_en' => 'Mashhad', 'name_fa' => 'مشهد', 'state_id' => 11], // خراسان رضوی
            ['name_en' => 'Isfahan', 'name_fa' => 'اصفهان', 'state_id' => 6], // اصفهان
            ['name_en' => 'Karaj', 'name_fa' => 'کرج', 'state_id' => 2], // البرز
            ['name_en' => 'Shiraz', 'name_fa' => 'شیراز', 'state_id' => 17], // فارس
            ['name_en' => 'Tabriz', 'name_fa' => 'تبریز', 'state_id' => 3], // آذربایجان شرقی
            ['name_en' => 'Qom', 'name_fa' => 'قم', 'state_id' => 19], // قم
            ['name_en' => 'Ahvaz', 'name_fa' => 'اهواز', 'state_id' => 13], // خوزستان
            ['name_en' => 'Kermanshah', 'name_fa' => 'کرمانشاه', 'state_id' => 22], // کرمانشاه
            ['name_en' => 'Urmia', 'name_fa' => 'ارومیه', 'state_id' => 4], // آذربایجان غربی
        ];
        City::insert($cities);
    }
}
