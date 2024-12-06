<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\City;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin City */
class CityResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_fa' => $this->name_fa,
            'is_active' => $this->getStatus($this->is_active),
            'state_id' => $this->state_id,
            'state' => $this->relationLoaded('state') ? StateResource::make($this->state) : null,
        ];
    }
}
