<?php

namespace App\Models;

use App\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Provider extends Authenticatable implements MustVerifyEmail
{
    use notifiable;

    protected $fillable = [
        'name_en',
        'name_fa',
        'class',
        'email',
        'website',
        'phone',
        'password',
        'api_key',
        'status',
        'signup_step',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'api_key',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail);
    }
    public function managers(): HasMany
    {
        return $this->hasMany(Manager::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(Media::class, 'model_id')->where('model_type', self::class);
    }
}

