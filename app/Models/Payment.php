<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    const  STATUS_PENDING = 0;
    const  STATUS_START = 1;
    const  STATUS_START_VERIFY = 2;
    const  STATUS_SUCCESS = 3;
    const  STATUS_FAILED = 4;
    protected $fillable = [
        'user_id',
        'gateway_id',
        'amount',
        'status',
        'transaction_id',
        'failure_reason',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }
}
