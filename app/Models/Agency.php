<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Agency extends Model
{
    protected $table = 'agencies';

    protected $fillable = [
        'user_id',
        'name_en',
        'name_fa',
        'is_active',
    ];


    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function services(): HasMany
    {
        return $this->hasMany(AgencyService::class);
    }
    public function contract(): HasOne
    {
        return $this->hasOne(Contract::class);
    }

}
