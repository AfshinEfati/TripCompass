<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Country;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Country */
class CountryResource extends JsonResource
{
    use StatusTrait;
    public function toArray(Request $request): array
    {
        return [
            'name_en'=>$this->name_en,
            'name_fa'=>$this->name_fa,
            'title_fa'=>$this->title_fa,
            'iso_code'=>$this->iso_code,
            'iso_code_3'=>$this->iso_code_3,
            'is_active'=>$this->getStatus($this->is_active),
            'states'=>$this->relationLoaded('states')?StateResource::collection($this->states): null,
        ];
    }
}
