<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Airline;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Airline */
class AirlineResource extends JsonResource
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
            'country_id' => $this->country_id,
            'logo_url' => $this->logo_url,
            'is_active' => $this->getStatus($this->is_active),
            'description' => $this->description,
            'country'=>$this->relationLoaded('country') ? new CountryResource($this->country) : null,
        ];
    }
}
