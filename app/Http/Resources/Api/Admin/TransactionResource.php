<?php

namespace App\Http\Resources\Api\Admin;

use App\Http\Resources\Api\Panel\PaymentResource;
use App\Models\Transaction;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Transaction */
class TransactionResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'type' => $this->type,
            'description' => $this->description,
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),

            'payment' => new PaymentResource($this->payment),
            'user' => new UserResource($this->user),
        ];
    }
}
