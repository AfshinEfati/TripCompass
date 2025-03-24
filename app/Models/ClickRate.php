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
}
