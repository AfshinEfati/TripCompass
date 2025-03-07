<?php

namespace App\Http\Resources\Api\Admin;

use App\Http\Resources\Api\Panel\ContractResource;
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
            'is_active' => $this->getStatus($this->is_active),
            'owner' => UserResource::make($this->owner),
            'services' => AgencyServiceResource::collection($this->services),
            'contract' => ContractResource::make($this->contract),
        ];
    }
}
