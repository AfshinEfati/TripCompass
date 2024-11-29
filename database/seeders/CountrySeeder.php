<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create([
            'name_en' => 'Iran',
            'name_fa' => 'ایران',
            'title_fa' => 'جمهوری اسلامی ایران',
            'iso_code' => 'IR',
            'iso_code_3' => 'IRN',
            'is_active' => true,
        ]);
    }
}
