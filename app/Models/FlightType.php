<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightType extends Model
{
    protected $table = 'flight_types';
    protected $fillable = ['name_en', 'name_fa'];
    protected $casts=[
        'name_en' => 'string',
        'name_fa' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';
}
