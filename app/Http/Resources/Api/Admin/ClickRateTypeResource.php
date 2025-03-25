<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\ClickRateType;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ClickRateType */
class ClickRateTypeResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'title' => $this->title,
            'rule' => $this->rule,
            'is_active' => $this->getStatus($this->is_active),
            'sort_order' => $this->sort_order,
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),

        ];
    }
}
