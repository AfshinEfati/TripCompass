<?php

namespace Database\Seeders;

use App\Models\Airport;
use App\Models\Seo;
use Illuminate\Database\Seeder;

class AirportSeoSeeder extends Seeder
{
    public function run(): void
    {
        $airports = Airport::where('domestic_flight', 1)->get();
        foreach ($airports as $airport) {
            foreach ($airports as $airport2) {
                if ($airport->id !== $airport2->id) {
                    $airportName = strtoupper($airport->iata_code);
                    $airport2Name = strtoupper($airport2->iata_code);
                    $seo = Seo::query()->where('canonical', "flight/{$airportName}-{$airport2Name}")->first();
                    if ($seo) {
                        continue;
                    }
                    $seo = Seo::create([
                        'title' => $airport->city->name_fa . ' به ' . $airport2->city->name_fa,
                        'description' => $airport->city->name_fa . ' به ' . $airport2->city->name_fa,
                        'canonical' => "flight/{$airportName}-{$airport2Name}",
                        'robots' => 0
                    ]);
                    $seo->content()->create([
                        'title_fa' => $seo->title,
                        'content' => $seo->title
                    ]);
                    $seo->seoRelation()->createMany([
                        [
                            "model_id" => $airport->id,
                            "model_type" => Airport::class,
                            "relation_type" => "origin"
                        ],
                        [
                            "model_id" => $airport2->id,
                            "model_type" => Airport::class,
                            "relation_type" => "destination"
                        ]
                    ]);
                }
            }
        }
    }
}
