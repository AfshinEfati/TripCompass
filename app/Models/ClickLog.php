<?php

namespace App\Models;

use App\Enums\Click\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClickLog extends Model
{

    protected $fillable = [
        'provider_id',
        'product_id',
        'product_type',
        'ip_address',
        'clicked_at',
    ];

    protected $casts = [
        'product_type' => ProductType::class,
        'clicked_at' => 'datetime',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}
