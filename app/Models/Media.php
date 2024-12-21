<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = [
        'file_path',
        'file_type',
        'file_name',
        'file_size',
        'mime_type',
        'priority',
        'model_id',
        'model_type'
    ];


    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function booted(): void
    {
        static::deleting(function ($media) {
            if (Storage::exists($media->file_path)) {
                Storage::delete($media->file_path);
            }
        });
    }
}
