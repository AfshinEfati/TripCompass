<?php

namespace App\Services\Agency\Vendors\Sepehrhub;

use App\Models\Airport;
use App\Repositories\Interfaces\AirportRepositoryInterface;
use App\Services\Agency\VendorAPI;
use App\Services\AirportService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SepehrhubService implements VendorAPI
{

    protected array $config;
    protected AirportService $airportService;

    public function __construct($config)
    {
        $this->config = $config;
        $this->airportService = app(AirportService::class);
    }

    /**
     * @throws ConnectionException
     */
    public function fetchFlights($requestData)
    {
        $origin = $this->airportService->show($requestData['origin'])->iata_code;
        $destination = $this->airportService->show($requestData['destination'])->iata_code;
        $body = [
            'UserName' => $this->config['username'],
            'Password' => $this->config['password'],
            "OriginDestinationOptionList" => [
                [
                    "OriginIataCode" =>$origin,
                    "DestinationIataCode" =>$destination,
                    "FlightDate" => $requestData['date'],
                ]
            ],
            "FetchSupplierWebserviceFlights" => false,
            "FetchFlightsThatAreRestrictedForTour" => false,
            "Language" => "FA"
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Accept-Encoding' => 'gzip, deflate',
        ];
        $response =  Http::withHeaders($headers)->post($this->config['endpoint'], $body)->json();
        Log::info('Sepehrhub flights fetched', $response);
        return $response;
    }

    public function fetchHotels()
    {
        return Http::get($this->config['endpoint'], [
            'api_key' => $this->config['api_key']
        ])->json();
    }
}
