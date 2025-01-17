<?php

namespace App\Models;

use App\Enums\Payment\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'bank_id',
        'authority',
        'reference',
        'status',
        'amount'
    ];

    protected $casts = [
        'status' => PaymentStatus::class, // Automatically cast status to PaymentStatus enum
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'payment_id');
    }
}
