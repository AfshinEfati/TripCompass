<?php

namespace App\Http\Resources\Api\Frontend;

use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
/** @mixin Seo */
class SitemapResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'canonical' => $this->canonical,
        ];
    }
}
