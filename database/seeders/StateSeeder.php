<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name_en' => 'Tehran', 'name_fa' => 'تهران', 'country_id' => 1],
            ['name_en' => 'Aalborg', 'name_fa' => 'البرز', 'country_id' => 1],
            ['name_en' => 'East Azerbaijan', 'name_fa' => 'آذربایجان شرقی', 'country_id' => 1],
            ['name_en' => 'West Azerbaijan', 'name_fa' => 'آذربایجان غربی', 'country_id' => 1],
            ['name_en' => 'Ardabil', 'name_fa' => 'اردبیل', 'country_id' => 1],
            ['name_en' => 'Isfahan', 'name_fa' => 'اصفهان', 'country_id' => 1],
            ['name_en' => 'Ilam', 'name_fa' => 'ایلام', 'country_id' => 1],
            ['name_en' => 'Bushehr', 'name_fa' => 'بوشهر', 'country_id' => 1],
            ['name_en' => 'Chaharmahal and Bakhtiari', 'name_fa' => 'چهارمحال و بختیاری', 'country_id' => 1],
            ['name_en' => 'South Khorasan', 'name_fa' => 'خراسان جنوبی', 'country_id' => 1],
            ['name_en' => 'Razavi Khorasan', 'name_fa' => 'خراسان رضوی', 'country_id' => 1],
            ['name_en' => 'North Khorasan', 'name_fa' => 'خراسان شمالی', 'country_id' => 1],
            ['name_en' => 'Khuzestan', 'name_fa' => 'خوزستان', 'country_id' => 1],
            ['name_en' => 'Zanjan', 'name_fa' => 'زنجان', 'country_id' => 1],
            ['name_en' => 'Semnan', 'name_fa' => 'سمنان', 'country_id' => 1],
            ['name_en' => 'Sistan and Baluchestan', 'name_fa' => 'سیستان و بلوچستان', 'country_id' => 1],
            ['name_en' => 'Fars', 'name_fa' => 'فارس', 'country_id' => 1],
            ['name_en' => 'Qazvin', 'name_fa' => 'قزوین', 'country_id' => 1],
            ['name_en' => 'Qom', 'name_fa' => 'قم', 'country_id' => 1],
            ['name_en' => 'Kurdistan', 'name_fa' => 'کردستان', 'country_id' => 1],
            ['name_en' => 'Kerman', 'name_fa' => 'کرمان', 'country_id' => 1],
            ['name_en' => 'Kermanshah', 'name_fa' => 'کرمانشاه', 'country_id' => 1],
            ['name_en' => 'Kohgiluyeh and Boyer-Ahmad', 'name_fa' => 'کهگیلویه و بویراحمد', 'country_id' => 1],
            ['name_en' => 'Golestan', 'name_fa' => 'گلستان', 'country_id' => 1],
            ['name_en' => 'Gilan', 'name_fa' => 'گیلان', 'country_id' => 1],
            ['name_en' => 'Lorestan', 'name_fa' => 'لرستان', 'country_id' => 1],
            ['name_en' => 'Mazandaran', 'name_fa' => 'مازندران', 'country_id' => 1],
            ['name_en' => 'Markazi', 'name_fa' => 'مرکزی', 'country_id' => 1],
            ['name_en' => 'Hormozgan', 'name_fa' => 'هرمزگان', 'country_id' => 1],
            ['name_en' => 'Hamadan', 'name_fa' => 'همدان', 'country_id' => 1],
            ['name_en' => 'Yazd', 'name_fa' => 'یزد', 'country_id' => 1],
        ];
        State::insert($states);
    }
}
