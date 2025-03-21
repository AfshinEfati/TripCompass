<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    protected $fillable = ['name', 'fa_name','driver', 'status', 'is_default', 'config'];
    protected $casts = [
        'config' => 'array',
    ];
    protected $table = 'gateways';

}
