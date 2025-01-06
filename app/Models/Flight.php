<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{
    protected $table = 'flights';
    protected $fillable = [
        'agency_id',
        'origin_id',
        'destination_id',
        'departure_date',
        'return_date',
        'flight_type',
        'flight',
    ];
    protected $casts = [
        'departure_date' => 'datetime',
        'return_date' => 'datetime',
        'flight' => 'array',
    ];
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }
}
