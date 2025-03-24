<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickRateType extends Model
{
    protected $fillable = [
        'code',
        'title',
        'rule',
        'is_active',
        'sort_order',
    ];

    public function rates()
    {
        return $this->hasMany(ClickRate::class, 'click_rate_type_id');
    }
}
