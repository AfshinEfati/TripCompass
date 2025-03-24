<?php

namespace App\Http\Resources\Api\Panel;

use App\Http\Resources\Api\Admin\AgencyResource;
use App\Http\Resources\Api\Admin\TransactionResource;
use App\Models\AgencyWallet;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin AgencyWallet */
class AgencyWalletResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'balance' => $this->balance,
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),
            'transactions_count' => $this->transactions_count,

            'agency_id' => $this->agency_id,

            'agency' => new AgencyResource($this->whenLoaded('agency')),
            'transactions' => TransactionResource::collection($this->whenLoaded('transactions')),
        ];
    }
}
