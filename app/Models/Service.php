<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'name_en',
        'name_fa',
        'is_active',
    ];

    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_service')->withPivot('is_active')->withTimestamps();
    }
}
