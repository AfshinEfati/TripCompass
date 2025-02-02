<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Manager extends Model
{


    protected $fillable = [
        'provider_id',
        'name_en',
        'family_en',
        'name_fa',
        'family_fa',
        'mobile',
        'national_id',
        'gender',
        'birthday',
        'address',
        'position',
    ];

    protected $casts = [
        'gender' => Gender::class,
        'birthday' => 'date',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}
