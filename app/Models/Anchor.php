<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anchor extends Model
{
    protected $fillable = ['seo_id', 'url', 'title'];
    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class);
    }
}
