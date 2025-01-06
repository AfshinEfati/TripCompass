<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Faq */
class FaqResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'answer' => $this->answer,
            'content' =>$this->relationLoaded('content') ? new ContentResource($this->content) : null,
        ];
    }
}
