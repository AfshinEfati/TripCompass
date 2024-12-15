<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\SeoRelation;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin SeoRelation */
class SeoRelationResource extends JsonResource
{
    use StatusTrait;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'model_id' => $this->model_id,
            'model_type' => $this->model_type,
            'relation_type' => $this->relation_type,
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),
            'seo_id' => $this->seo_id,
            'seo' => new SeoResource($this->whenLoaded('seo')),
        ];
    }
}
