<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Anchor;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Anchor */
class AnchorResource extends JsonResource
{
    use StatusTrait;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'title' => $this->title,
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),
        ];
    }
}
