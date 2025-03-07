<?php

namespace App\Http\Resources\Api\Panel;

use App\Http\Resources\Api\Admin\AgencyResource;
use App\Http\Resources\Api\Admin\UserResource;
use App\Http\Resources\Api\BankResource;
use App\Models\Contract;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Contract */
class ContractResource extends JsonResource
{
    use StatusTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'contract_type' => $this->contractType($this->contract_type),
            'license_number' => $this->license_number,
            'company_registration_number' => $this->company_registration_number,
            'national_id' => $this->national_id,
            'economic_code' => $this->economic_code,
            'contact_person' => $this->contact_person,
            'contact_national_id' => $this->contact_national_id,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'bank_account' => $this->bank_account,
            'bank_shaba' => $this->bank_shaba,
            'status' => $this->status($this->status),
            'created_at' => $this->formatDates($this->created_at),
            'updated_at' => $this->formatDates($this->updated_at),
            'agency' => new AgencyResource($this->whenLoaded('agency')),
            'user' => new UserResource($this->whenLoaded('user')),
            'bank' => new BankResource($this->bank),
        ];
    }

    private function contractType($type): array
    {
        return match ($type) {
            'CPA' => [
                'code' => 'CPA',
                'name' => 'Cost Per Action',
                'name_fa' => 'هزینه برای هر عمل',
                'description' => 'Cost Per Action',
            ],
            'subscription' => [
                'code' => 'subscription',
                'name' => 'Monthly Subscription',
                'name_fa' => 'اشتراک ماهیانه',
                'description' => 'Monthly Subscription',
            ],
            default => [
                'code' => 'CPC',
                'name' => 'Cost Per Click',
                'name_fa' => 'هزینه برای هر کلیک',
                'description' => 'Cost Per Click',
            ],
        };
    }

    private function status($status): array
    {
        return match ($status) {
            'reviewing' => [
                'code' => 1,
                'name' => 'Reviewing',
                'name_fa' => 'در حال بررسی',
                'description' => 'Reviewing',
            ],
            'approved' => [
                'code' => 2,
                'name' => 'Approved',
                'name_fa' => 'تایید شده',
                'description' => 'Approved',
            ],
            'rejected' => [
                'code' => 3,
                'name' => 'Rejected',
                'name_fa' => 'رد شده',
                'description' => 'Rejected',
            ],
            default => [
                'code' => 0,
                'name' => 'Pending',
                'name_fa' => 'در انتظار',
                'description' => 'Pending',
            ],
        };
    }
}
