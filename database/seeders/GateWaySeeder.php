<?php

namespace Database\Seeders;

use App\Models\Gateway;
use Illuminate\Database\Seeder;

class GateWaySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'name' => 'zibal',
            'fa_name' => 'زیبال',
            'driver' => 'Zibal',
            'status' => true,
            'is_default' => true,
            'config' => [
                "user" => "test",
                "merchant" => "67cae9b66f380300143fa473",
                "password" => "test"
            ]
        ];
        Gateway::query()->create($data);

    }
}
