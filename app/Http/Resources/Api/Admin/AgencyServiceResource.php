<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\AgencyService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin AgencyService */
class AgencyServiceResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'config' => [
                'endpoint' => $this->config->endpoint??null,
                'username' => $this->config->username??null,
                'password' => $this->config->password??null,
            ],
            'is_active' => $this->is_active,
            'agency' => new AgencyResource($this->whenLoaded('agency')),
            'service' => new ServiceResource($this->whenLoaded('service')),
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),

        ];
    }
}
