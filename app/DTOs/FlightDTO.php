<?php

namespace App\DTOs;

use Illuminate\Support\Str;

class FlightDTO
{
    public string $flightKey;
    public int $originId;
    public int $destinationId;
    public string $departureTime;
    public string $arrivalTime;
    public int $airlineId;
    public string $flightNumber;
    public int $agencyId;
    public array $priceDetails;
    public int $capacity;
    public string $class;
    public string $cabin_type;
    public bool $is_charter;
    public array $baggage;
    public string $currency;

    public function __construct(array $data)
    {
        $this->flightKey = $data['flight_key'] ?? (string)Str::uuid();
        $this->originId = $data['origin_id'] ?? 0;
        $this->destinationId = $data['destination_id'] ?? 0;
        $this->departureTime = $data['departure_time'] ?? '0000-00-00 00:00:00';
        $this->arrivalTime = $data['arrival_time'] ?? '0000-00-00 00:00:00';
        $this->airlineId = $data['airline_id'] ?? 0;
        $this->flightNumber = $data['flight_number'] ?? 'N/A';
        $this->agencyId = $data['agency_id'] ?? 0;
        $this->priceDetails = $data['price_details'] ?? [
            'adult' => 0,
            'child' => 0,
            'infant' => 0
        ];
        $this->capacity = $data['capacity'] ?? 0;
        $this->class = $data['class'] ?? 'Y';
        $this->cabin_type = $data['cabin_type'] ?? 'Economy';
        $this->is_charter = $data['is_charter'] ?? false;
        $this->baggage = $data['baggage'] ?? [
            'checked' => '0kg',
            'cabin' => '0kg'
        ];
        $this->currency = $data['currency'] ?? 'IRR';
    }

    public function toArray(): array
    {
        return [
            'flight_key' => $this->flightKey,
            'origin_id' => $this->originId,
            'destination_id' => $this->destinationId,
            'departure_time' => $this->departureTime,
            'arrival_time' => $this->arrivalTime,
            'airline_id' => $this->airlineId,
            'flight_number' => $this->flightNumber,
            'agency_id' => $this->agencyId,
            'price_details' => $this->priceDetails,
            'capacity' => $this->capacity,
            'class' => $this->class,
            'cabin_type' => $this->cabin_type,
            'is_charter' => $this->is_charter,
            'baggage' => $this->baggage,
            'currency' => $this->currency,
        ];
    }
}
