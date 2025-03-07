<?php

namespace App\Http\Resources\Api;

use App\Models\Bank;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Bank */
class BankResource extends JsonResource
{
    use StatusTrait;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_fa' => $this->name_fa,
            'name_en' => $this->name_en,
            'code' => $this->code,
            'swift_code' => $this->swift_code,
            'logo' => null,
            'created_at' =>$this->formatDates( $this->created_at),
            'updated_at' =>$this->formatDates( $this->updated_at),
        ];
    }
}
