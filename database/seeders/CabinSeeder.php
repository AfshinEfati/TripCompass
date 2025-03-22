<?php

namespace Database\Seeders;

use App\Models\Cabin;
use Illuminate\Database\Seeder;

class CabinSeeder extends Seeder
{
    public function run(): void
    {
        $cabinTypes = [
            [
                'name_en' => 'economy',
                'name_fa' => 'اکونومی',
                'code' => 'Y',
                'number' => 1
            ],
            [
                'name_en' => 'premium economy',
                'name_fa' => 'پریمیوم اکونومی',
                'code' => 'S',
                'number' => 2
            ],
            [
                'name_en' => 'business',
                'name_fa' => 'بیزینس',
                'code' => 'C',
                'number' => 3
            ],
            [
                'name_en' => 'premium business',
                'name_fa' => 'پریمیوم بیزینس',
                'code' => 'J',
                'number' => 4
            ],
            [
                'name_en' => 'first class',
                'name_fa' => 'فرست کلس',
                'code' => 'F',
                'number' => 5
            ],
            [
                'name_en' => 'premium first class',
                'name_fa' => 'پریمیوم فرست کلس',
                'code' => 'P',
                'number' => 6
            ],
        ];
        Cabin::query()->insert($cabinTypes);
    }
}
