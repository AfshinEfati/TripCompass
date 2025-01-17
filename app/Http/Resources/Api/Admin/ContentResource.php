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
        $words = 0;
        if ( $this->content !== null) {
            $words = explode(' ', strip_tags($this->content));
            $words= count($words);
        }
        return [
            'id' => $this->id,
            'title_fa' => $this->title_fa,
            'content' => $this->content,
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),
            'seo_id' => $this->seo_id,
            'words' => $words,
            'seo' => new SeoResource($this->whenLoaded('seo')),
        ];
    }
}
