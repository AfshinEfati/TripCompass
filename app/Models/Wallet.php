<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property null|int $provider_id
 * @property mixed $balance
 * @property mixed $locked_balance
 */
class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'balance',
        'locked_balance',
    ];

    protected $appends = ['available_balance'];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function isSystemWallet(): bool
    {
        return $this->provider_id === null;
    }

    public function getAvailableBalanceAttribute(): float
    {
        return $this->balance - $this->locked_balance;
    }
}

