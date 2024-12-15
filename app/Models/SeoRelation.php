<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoRelation extends Model
{
    protected $table = 'seo_relations';
    protected $fillable = ['seo_id', 'model_id', 'model_type', 'relation_type'];

    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class);
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
