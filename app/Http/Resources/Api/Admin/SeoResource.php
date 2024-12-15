<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Seo;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Seo */
class SeoResource extends JsonResource
{
    use StatusTrait;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'canonical' => $this->canonical,
            'robots' => $this->getStatus($this->robots),
            'created_at' =>$this->formatDates( $this->created_at),
            'updated_at' =>$this->formatDates( $this->updated_at),
            'contents' => ContentResource::make($this->whenLoaded('content')),
            'seo_relations' => SeoRelationResource::collection($this->whenLoaded('seoRelation')),
        ];
    }
}
