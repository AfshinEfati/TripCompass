<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    protected $fillable = [
        'name_en',
        'name_fa',
        'iata_code',
        'icao_code',
        'country_id',
        'logo_url',
        'is_active',
        'description',
    ];
}
