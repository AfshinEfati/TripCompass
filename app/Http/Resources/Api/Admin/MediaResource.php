<?php

namespace App\Http\Resources\Api\Admin;

use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    use StatusTrait;
    public function toArray(Request $request): array
    {
        if ($this->model_type) {
            $model =collect(explode('\\', $this->model_type))->last();
            $model_id = $this->model_id;
        }
        return [
            'id' => $this->id,
            'mime_type' => $this->mime_type,
            'file_url' =>$this->model_type?"media/$model/$model_id/$this->file_name" : 'media/' . $this->file_name,
            'priority' => $this->priority,
            'alt_text' => $this->alt_text,
        ];
    }
}
