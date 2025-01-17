<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airport extends Model
{
    protected $fillable = [
        'name_en',
        'name_fa',
        'iata_code',
        'icao_code',
        'city_id',
        'is_popular',
        'is_active',
        'foreign_flight',
        'domestic_flight',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
