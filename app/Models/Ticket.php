<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'admin_id',
        'agency_id',
        'receiver_user_id',
        'type',
        'status',
        'is_public'
    ];
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(TicketMessage::class);
    }
}
