<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Airport;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Airport */
class AirportResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_fa' => $this->name_fa,
            'iata_code' => $this->iata_code,
            'icao_code' => $this->icao_code,
            'is_popular' => $this->getStatus($this->is_popular),
            'is_active' => $this->getStatus($this->is_active),
            'foreign_flight' => $this->getStatus($this->foreign_flight),
            'domestic_flight' => $this->getStatus($this->domestic_flight),
            'city_id' => $this->city_id,
            'city' => $this->relationLoaded('city') ? new CityResource($this->whenLoaded('city')) : null,
        ];
    }
}
