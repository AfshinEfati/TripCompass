<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\ClickRate;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ClickRate */
class ClickRateResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'contract_type' => $this->contract_type,
            'rate' => $this->rate,
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),
            'agency' => new AgencyResource($this->whenLoaded('agency')),
            'service' => new ServiceResource($this->whenLoaded('service')),
            'type' => new ClickRateTypeResource($this->whenLoaded('type')),
        ];
    }
}
