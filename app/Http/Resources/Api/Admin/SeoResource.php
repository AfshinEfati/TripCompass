<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Seo;
use App\Traits\StatusTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Seo
 * @property mixed $id
 * @property mixed $title
 * @property mixed $description
 * @property mixed $canonical
 * @property mixed $robots
 * @property mixed $created_at
 * @property mixed $updated_at
 */
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
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),
            'contents' => ContentResource::make($this->whenLoaded('content')),
            'seo_relations' => SeoRelationResource::collection($this->whenLoaded('seoRelation')),
            'media' => MediaResource::collection($this->whenLoaded('media')),
            'anchors' => AnchorResource::collection($this->whenLoaded('anchors')),
            'faqs' => FaqResource::collection($this->whenLoaded('faqs')),
            'today' => $this->formatDates(Carbon::now()->format('Y-m-d H:i:s')),
            'tomorrow' => $this->formatDates(Carbon::tomorrow()->format('Y-m-d H:i:s')),
        ];
    }
}
