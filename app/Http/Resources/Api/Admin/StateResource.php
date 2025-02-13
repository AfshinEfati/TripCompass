<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\State;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin State */
class StateResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_fa' => $this->name_fa,
            'country_id' => $this->country_id,
            'is_active' => $this->getStatus((int)$this->is_active),
            'country' => $this->relationLoaded('country') ? CountryResource::make($this->country) : null,
        ];
    }
}
