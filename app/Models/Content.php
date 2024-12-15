<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    protected $fillable = ['seo_id', 'title_fa', 'content'];

    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class);
    }
}
