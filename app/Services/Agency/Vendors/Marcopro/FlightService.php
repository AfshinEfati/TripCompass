<?php

namespace App\Services\Agency\Vendors\Marcopro;

use App\DTOs\FlightDTO;
use App\Services\Agency\VendorAPI;
use App\Services\AirlineService;
use App\Services\AirportService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FlightService implements VendorAPI
{
    protected array $config;
    protected AirportService $airportService;
    protected AirlineService $airlineService;

    public function __construct($config)
    {
        $this->config = $config;
        $this->airportService = app(AirportService::class);
        $this->airlineService = app(AirlineService::class);
    }

    /**
     */
    public function fetchFlights(array $requestData): array
    {
        $origin = $this->airportService->show($requestData['origin'])->iata_code;
        $destination = $this->airportService->show($requestData['destination'])->iata_code;
        $body = [
            "from" => $origin,
            "to" => $destination,
            "departureDate" => $requestData['date'],
            "adult" => 1,
            "child" => 0,
            "infant" => 0
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',

        ];
        try {
            $response = Http::timeout(120)->withHeaders($headers)->post($this->config['endpoint'], $body);
            if (!$response->successful()) {
                return [];
            }
            $result = $response->json();
            $vendorFlights = $result['flights'] ?? [];
            return $this->mapMarcoProFlightsToDTO($vendorFlights, $requestData);
        } catch (\Throwable $e) {
            \Log::error("❌ Exception in Marcopro fetchFlights(): " . $e->getMessage());
            return [];
        }
    }

    public function fetchHotels()
    {
        // TODO: Implement fetchHotels() method.
    }


    public function mapMarcoProFlightsToDTO(array $vendorFlights, array $requestData, string $currency = 'IRR'): array
    {
        $flights = [];

        foreach ($vendorFlights as $vendorFlight) {
            $link = $vendorFlight['link'];
            foreach ($vendorFlight['trip']['legs'] ?? [] as $segment) {
                $flights[] = (new FlightDTO([
                    'origin_id' => $requestData['origin'],
                    'destination_id' => $requestData['destination'],
                    'departure_time' => "{$segment['departure']['date']} {$segment['departure']['time']}",
                    'arrival_time' => "{$segment['arrival']['date']} {$segment['arrival']['time']}",
                    'airline_id' => $this->airlineService->getAirlineIdByCode($segment['airline']['code']),
                    'flight_number' => $segment['flight_number'] ?? 'N/A',
                    'agency_id' => $this->config['agency_id'] ?? 1,
                    'price_details' => [
                        'adult' => $vendorFlight['trip']['prices']['adult'] ?? 0,
                        'child' => $vendorFlight['trip']['prices']['child'] ?? 0,
                        'infant' => $vendorFlight['trip']['prices']['infant'] ?? 0,
                    ],
                    'capacity' => $segment['capacity'] ?? 0,
                    'class' => $segment['class'] ?? 'Y',
                    'cabin_type' => $segment['cabin_type'] ?? 'Economy',
                    'is_charter' => $vendorFlight['trip']['type'] === 'CHARTER',
                    'baggage' => [
                        'checked' => ($vendorFlight['trip']['baggage'][0]['weight'] ?? 0) . 'kg',
                        'cabin' => ($vendorFlight['trip']['baggage'][1]['weight'] ?? 0) . 'kg',
                    ],
                    'call_back' => $link,
                    'currency' => $currency,
                ]))->toArray();
            }
        }

        return $flights;
    }


}
