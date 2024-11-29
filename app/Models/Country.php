<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
