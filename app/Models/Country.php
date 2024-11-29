<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name_en',
        'name_fa',
        'title_fa',
        'iso_code',
        'iso_code_3',
        'is_active',
    ];
}
