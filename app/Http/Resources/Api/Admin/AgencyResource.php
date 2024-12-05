<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Agency;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Agency */
class AgencyResource extends JsonResource
{
    use StatusTrait;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_fa' => $this->name_fa,
            'base_url' => $this->base_url,
            'contract_type' => $this->contract_type,
            'commission_rate' => $this->commission_rate,
            'fixed_rate' => $this->fixed_rate,
            'is_active' => $this->getStatus($this->is_active),
            'user' => $this->relationLoaded('user') ? new UserResource($this->user) : null,
        ];
    }
}
