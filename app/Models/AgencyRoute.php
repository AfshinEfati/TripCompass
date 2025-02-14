<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgencyRoute extends Model
{
    protected $fillable = [
        'agency_id',
        'origin_id',
        'destination_id',
        'days_available',
        'priority',
        'last_updated',
        'auto_generated'
    ];

    protected $casts = [
        'days_available' => 'array', // تبدیل JSON به آرایه
        'last_updated' => 'datetime',
    ];

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function origin(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'origin_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'destination_id');
    }
}
