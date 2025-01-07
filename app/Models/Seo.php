<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Seo extends Model
{
    protected $fillable = ['title', 'description', 'canonical', 'robots'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function content(): HasOne
    {
        return $this->hasOne(Content::class);
    }

    public function seoRelation(): HasMany
    {
        return $this->hasMany(SeoRelation::class);
    }
    public function media(): HasMany
    {
        return $this->hasMany(Media::class, 'model_id')->where('model_type', self::class);
    }
    public function anchors(): HasMany
    {
        return $this->hasMany(Anchor::class);
    }
    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

}
