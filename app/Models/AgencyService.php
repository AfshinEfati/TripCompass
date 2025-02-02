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
        'endpoint_url',
        'username',
        'password',
        'is_active',
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
