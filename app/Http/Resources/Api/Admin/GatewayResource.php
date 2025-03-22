<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Gateway;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Gateway */
class GatewayResource extends JsonResource
{
    use StatusTrait;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'fa_name' => $this->fa_name,
            'driver' => $this->driver,
            'status' => $this->status,
            'is_default' => $this->getStatus($this->is_default),
            'config' => $this->config,
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),
        ];
    }
}
