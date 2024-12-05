<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\User;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'username' => $this->username,
            'avatar' => $this->avatar,
            'is_admin' => $this->getStatus($this->is_admin),
            'is_active' => $this->getStatus($this->is_active),
            'balance' => $this->balance,
            'agencies'=>$this->relationLoaded('agencies') ? /*AgencyResource::collection(*/$this->agencies/*)*/ : [],
            'token' => $this->additional['token'] ?? null,
        ];
    }
}
