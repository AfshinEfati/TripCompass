<?php

namespace App\Services\Agency;

use App\Jobs\FetchFlightForRouteJob;
use App\Models\Agency;
use App\Models\AgencyService;
use App\Models\AgencyRoute;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class FetchAgencyDataService
{
    /**
     * @throws Throwable
     */
    public function fetchAllFlights(): string
    {

        $services = AgencyService::query()->where('is_active', 1)->where('service_id', 1)->with('service')->get();
        foreach ($services as $service) {
            $vendor = $service->vendor;
            $className = ucfirst($service->service->name_en);
            $vendorClass = "App\\Services\\Agency\\Vendors\\{$vendor}\\{$className}Service";
            if (!class_exists($vendorClass)) {
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
                    FetchFlightForRouteJob::dispatch($vendorInstance, $origin, $destination, $flightDate, $service->agency_id)
                        ->onQueue('high-priority');
                }
            }
        }
        return "All flights jobs dispatched for the next week.";
    }

    /**
     * @throws Throwable
     */
    public function storeFlightsInDatabase(array $flights, int $agencyId): void
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
