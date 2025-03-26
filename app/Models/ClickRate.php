<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClickRate extends Model
{
    protected $fillable = [
        'service_id',
        'click_rate_type_id',
        'agency_id',
        'contract_type',
        'rate',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ClickRateType::class, 'click_rate_type_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }



    public static function getRate(int $serviceId, ?int $agencyId = null, ?string $contractType = null, ?int $clickRateTypeId = null): ?int
    {
        return self::query()
            ->when($clickRateTypeId, fn($q) => $q->where('click_rate_type_id', $clickRateTypeId))
            ->when($contractType, fn($q) => $q->where('contract_type', $contractType))
            ->when($agencyId, fn($q) => $q->where('agency_id', $agencyId))
            ->where('service_id', $serviceId)
            ->orderByDesc('agency_id')  // اولویت: خاص‌تر
            ->orderByDesc('click_rate_type_id')
            ->orderByDesc('id')
            ->value('rate');
    }

}
