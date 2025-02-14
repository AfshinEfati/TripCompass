<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgencyService extends Model
{
    protected $table = 'agency_services';

    protected $fillable = [
        'agency_id',
        'service_id',
        'vendor',
        'config',
        'daily_request_limit',
        'min_update_interval',
        'no_route_restriction',
        'is_active',
    ];
    protected $casts = [
        'config' => 'array',
        'is_active' => 'boolean',
    ];


    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }


    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
