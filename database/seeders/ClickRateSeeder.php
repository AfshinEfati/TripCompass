<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClickRateType;
use App\Models\ClickRate;

class ClickRateSeeder extends Seeder
{
    public function run(): void
    {
        $defaultType = ClickRateType::updateOrCreate([
            'code' => 'default',
        ], [
            'title' => 'Default Rate',
            'rule' => null,
            'is_active' => true,
            'sort_order' => 0,
        ]);

        ClickRate::updateOrCreate([
            'click_rate_type_id' => $defaultType->id,
            'service_id' => null,
            'agency_id' => null,
            'contract_type' => null,
        ], [
            'rate' => 10000, // in Rials
        ]);
    }
}
