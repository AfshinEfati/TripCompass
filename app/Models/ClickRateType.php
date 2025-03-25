<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClickRateType extends Model
{
    protected $fillable = [
        'code',
        'title',
        'rule',
        'is_active',
        'sort_order',
    ];

    public function rates(): HasMany|ClickRateType
    {
        return $this->hasMany(ClickRate::class, 'click_rate_type_id');
    }
}
