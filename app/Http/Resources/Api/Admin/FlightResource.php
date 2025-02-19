<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Flight;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Flight */
class FlightResource extends JsonResource
{
    use StatusTrait;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'flight_key' => $this->flight_key,
            'departure_time' => $this->fromDateTime($this->departure_time),
            'arrival_time' => $this->formatDates($this->arrival_time),
            'flight_number' => $this->flight_number,
            'price_details' => $this->price_details,
            'capacity' => $this->capacity,
            'cabin_type' => $this->cabin_type,
            'class' => $this->class,
            'is_charter' => $this->getStatus($this->is_charter),
            'baggage' => $this->baggage,
            'currency' => $this->currency,
            'origin_id' => $this->origin_id,
            'destination_id' => $this->destination_id,
            'airline_id' => $this->airline_id,
            'agency_id' => $this->agency_id,
            'agency' => new AgencyResource($this->whenLoaded('agency')),
            'airline' => new AirlineResource($this->whenLoaded('airline')),
            'destination' => new AirportResource($this->whenLoaded('destination')),
            'origin' => new AirportResource($this->whenLoaded('origin')),
        ];
    }
}
