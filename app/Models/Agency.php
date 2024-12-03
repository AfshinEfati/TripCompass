<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agency extends Model
{
    protected $fillable = [
        'name_en',
        'name_fa',
        'base_url',
        'contract_type',
        'commission_rate',
        'fixed_rate',
        'user_id',
    ];
    /**
     * Get the user associated with the agency.
     *
     * This function defines the relationship between the Agency model
     * and the User model, indicating that an agency belongs to a user.
     *
     * @return BelongsTo The relationship instance.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
