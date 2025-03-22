<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Cabin;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Cabin */
class CabinResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_fa' => $this->name_fa,
            'code' => $this->code,
            'number' => $this->number,
            'status' => $this->getStatus($this->status),
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),
        ];
    }
}
