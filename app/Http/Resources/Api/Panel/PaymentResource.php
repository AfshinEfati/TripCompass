<?php

namespace App\Http\Resources\Api\Panel;

use App\Http\Resources\Api\Admin\GatewayResource;
use App\Http\Resources\Api\Admin\UserResource;
use App\Models\Payment;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Payment */
class PaymentResource extends JsonResource
{
    use StatusTrait;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'status' => $this->status($this->status),
            'transaction_id' => $this->transaction_id,
            'failure_reason' => $this->failure_reason,
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),
            'gateway' => GatewayResource::make($this->gateway),
            'user' => UserResource::make($this->user),
        ];
    }
    private function status(string $status): array
    {
        $statuses = [
            'success' => [
                'code' => 1,
                'name' => 'success',
                'name_fa' => 'موفق',
            ],
            'pending' => [
                'code' => 0,
                'name' => 'pending',
                'name_fa' => 'در انتظار',
            ],
            'canceled' => [
                'code' => 0,
                'name' => 'canceled',
                'name_fa' => 'لغو شده',
            ],
            'failed' => [
                'code' => 0,
                'name' => 'failed',
                'name_fa' => 'ناموفق',
            ],
        ];

        return $statuses[$status] ?? $statuses['pending'];
    }
}
