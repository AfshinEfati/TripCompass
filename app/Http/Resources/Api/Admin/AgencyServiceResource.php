<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\AgencyService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin AgencyService */
class AgencyServiceResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
//        dd(ServiceResource::make($this->service));
        return [
            'id' => $this->id,
            'config' =>$this->config,
            'is_active' => $this->getStatus($this->is_active),
//            'agency' => AgencyResource::make($this->agency),
            'service' => ServiceResource::make($this->service),
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),

        ];
    }
}
