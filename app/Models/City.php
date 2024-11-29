<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'name_en',
        'name_fa',
        'state_id',
        'is_active',
    ];
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
