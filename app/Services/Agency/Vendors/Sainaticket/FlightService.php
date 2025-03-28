<?php

namespace App\Services\Agency\Vendors\Sainaticket;

use App\DTOs\FlightDTO;
use App\Services\Agency\VendorAPI;
use App\Services\AirlineService;
use App\Services\AirportService;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;


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
     * @throws Exception
     */
    public function fetchFlights($requestData): array
    {
        $origin = $this->airportService->show($requestData['origin'])->iata_code;
        $destination = $this->airportService->show($requestData['destination'])->iata_code;
        $body = [
            'UserName' => $this->config['username'],
            'Password' => $this->config['password'],
            "OriginDestinationOptionList" => [
                [
                    "OriginIataCode" => $origin,
                    "DestinationIataCode" => $destination,
                    "FlightDate" => $requestData['date'],
                ]
            ],
            "FetchSupplierWebserviceFlights" => true,
            "FetchFlightsThatAreRestrictedForTour" => false,
            "Language" => "FA"
        ];
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Accept-Encoding' => 'gzip, deflate',
        ];

        try {
            $response = Http::timeout(120)->withHeaders($headers)->post($this->config['endpoint'], $body);
            if (!$response->successful()) {
                throw new Exception("Agency API Request Failed: " . $response->status());
            }

            $result = $response->json();
            $currency = $result['CurrencyCode'] ?? 'IRR';
            if (empty($result['ItineraryList'])) {
                return []; // ✅ اگر خالی بود، پردازش ادامه پیدا نمی‌کند
            }
            $flights = [];
            foreach ($result['ItineraryList'] as $itinerary) {
                foreach ($itinerary['FlightSegmentList'] ?? [] as $segment) {
                    $flightClass = $segment['FlightClass'] ?? [];
                    $adultFare = $flightClass['AdultFare']['TotalFare'] ?? 0;
                    $availableSeats = $flightClass['AvailableSeat'] ?? 0;

                    $originId = $requestData['origin'];
                    $destinationId = $requestData['destination'];
                    $airlineId = $this->airlineService->getAirlineIdByCode($segment['Airline']);

                    $flights[] = (new FlightDTO([
                        'origin_id' => $originId,
                        'destination_id' => $destinationId,
                        'departure_time' => $segment['DepartureDateTime'] ?? '0000-00-00 00:00:00',
                        'arrival_time' => $segment['ArrivalDateTime'] ?? '0000-00-00 00:00:00',
                        'airline_id' => $airlineId,
                        'flight_number' => $segment['FlightNumber'] ?? 'N/A',
                        'agency_id' => $this->config['agency_id'] ?? 1,
                        'price_details' => [
                            'adult' => $adultFare,
                            'child' => $flightClass['ChildFare']['TotalFare'] ?? 0,
                            'infant' => $flightClass['InfantFare']['TotalFare'] ?? 0,
                        ],
                        'capacity' => $availableSeats,
                        'class' => $flightClass['BookingCode'] ?? 'Y',
                        'cabin_type' => $flightClass['CabinType'] ?? 'Economy',
                        'is_charter' => $flightClass['RestrictedForTour'] ?? false,
                        'baggage' => [
                            'checked' => ($flightClass['AdultFreeBaggage']['CheckedBaggageTotalWeight'] ?? 0) . 'kg',
                            'cabin' => ($flightClass['AdultFreeBaggage']['HandBaggageTotalWeight'] ?? 0) . 'kg',
                        ],
                        'currency' => $result['CurrencyCode'] ?? 'IRR',
                        'call_back' => "https://charter.alibaba.ir/api/DeepLink/Flight/Availability/Oneway/SpecificFlight/V1?"
                            . "origin={$segment['Origin']['Code']}"
                            . "&destination={$segment['Destination']['Code']}"
                            . "&departureDate={$requestData['date']}"
                            . "&flightNumber={$segment['FlightNumber']}"
                            . "&fareName=" . urlencode($flightClass['FareName'] ?? '')
                            . "&language=FA&utmSource=rundev.ir",
                    ]))->toArray();
                }
            }
            return $flights;

        } catch (\Throwable $e) {
            return [];
        }
    }


    public function fetchHotels()
    {
        return Http::get($this->config['endpoint'], [
            'api_key' => $this->config['api_key']
        ])->json();
    }
}
