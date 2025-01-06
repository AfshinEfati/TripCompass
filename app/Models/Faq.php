<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'seo_id',
    ];

    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class);
    }

}
