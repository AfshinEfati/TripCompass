<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

}
