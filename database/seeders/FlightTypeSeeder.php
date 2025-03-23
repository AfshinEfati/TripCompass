<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FlightTypeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name_en' => 'charter',
                'name_fa' => 'چارتر'
            ],
            [
                'name_en' => 'system',
                'name_fa' => 'سیستمی'
            ]
        ];
        \App\Models\FlightType::insert($data);
    }
}
