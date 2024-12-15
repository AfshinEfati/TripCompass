<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Content;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Content */
class ContentResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title_fa' => $this->title_fa,
            'content' => $this->content,
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),

            'seo_id' => $this->seo_id,

            'seo' => new SeoResource($this->whenLoaded('seo')),
        ];
    }
}
