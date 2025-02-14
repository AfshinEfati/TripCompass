<?php
namespace App\Services\Agency;

use App\Models\Agency;
use App\Models\AgencyService;
use App\Models\AgencyRoute;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class FetchAgencyDataService {
    /**
     * @throws Throwable
     */
    public function fetchAllFlights(): string
    {
        \Log::info("FetchFlightsJob started.");
        $services = AgencyService::where('service_id', 1)->get();
        foreach ($services as $service) {
            $vendor = $service->vendor;
            $vendorClass = "App\\Services\\Agency\\Vendors\\{$vendor}\\{$vendor}Service";
            if (!class_exists($vendorClass)) {
                \Log::error("Vendor class {$vendorClass} not found for agency {$service->agency_id}");
                continue;
            }

            $config = $service->config;
            $config['agency_id'] = $service->agency_id;
            $vendorInstance = new $vendorClass($config);

            $routes = AgencyRoute::where('agency_id', $service->agency_id)->get();

            foreach ($routes as $route) {
                $origin = $route->origin_id;
                $destination = $route->destination_id;
                $today = Carbon::today();

                for ($i = 0; $i < 7; $i++) {
                    $flightDate = $today->copy()->addDays($i)->toDateString();
                    $requestData = [
                        'origin' => $origin,
                        'destination' => $destination,
                        'date' => $flightDate,
                        'flight_type' => 'one_way',
                        'passengers' => [
                            'ADT' => 1,
                            'CHD' => 0,
                            'INF' => 0
                        ]
                    ];
                    $flights = $vendorInstance->fetchFlights($requestData);

                    if (!empty($flights)) {
                        $this->storeFlightsInDatabase($flights, $service->agency_id);
                    }
                }
            }
        }
        \Log::info("FetchFlightsJob completed.");
        return "All flights fetched for the next week.";
    }

    /**
     * @throws Throwable
     */
    private function storeFlightsInDatabase(array $flights, int $agencyId): void
    {
        if (!Agency::where('id', $agencyId)->exists()) {
            return;
        }
        DB::transaction(function () use ($flights, $agencyId) {
            foreach ($flights as $flightData) {
                $existingFlight = Flight::where([
                    'flight_number' => $flightData['flight_number'],
                    'departure_time' => $flightData['departure_time'],
                    'origin_id' => $flightData['origin_id'],
                    'destination_id' => $flightData['destination_id'],
                    'agency_id' => $agencyId,
                ])->first();

                if ($existingFlight) {
                    $existingFlight->update([
                        'price_details' => $flightData['price_details'],
                        'capacity' => $flightData['capacity'],
                        'class' => $flightData['class'],
                        'baggage' => $flightData['baggage'],
                        'currency' => $flightData['currency'],
                    ]);
                } else {
                    Flight::create($flightData);
                }
            }
        });
    }
}
