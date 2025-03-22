<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabin extends Model
{
    protected $table = 'cabins';
    protected $fillable = [
        'name_en',
        'name_fa',
        'code',
        'number',
        'status',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

}
