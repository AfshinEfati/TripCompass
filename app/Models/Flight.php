<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Flight extends Model
{
    protected $fillable = [
        'flight_key',
        'origin_id',
        'destination_id',
        'departure_time',
        'arrival_time',
        'airline_id',
        'flight_number',
        'agency_id',
        'price_details',
        'capacity',
        'class',
        'baggage',
        'currency',
        'cabin_type',
        'is_charter'
    ];

    protected $casts = [
        'price_details' => 'array', // تبدیل JSON به آرایه
        'baggage' => 'array', // تبدیل JSON به آرایه
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
    ];


    public function origin(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'origin_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'destination_id');
    }

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    // مقدار پیش‌فرض برای flight_key
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($flight) {
            $flight->flight_key = (string)Str::uuid();
        });
    }

}
