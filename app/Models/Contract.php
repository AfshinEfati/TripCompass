<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    protected $table = 'contracts';
    protected $fillable = [
        'agency_id',
        'user_id',
        'contract_type',
        'license_number',
        'company_registration_number',
        'national_id',
        'economic_code',
        'contact_person',
        'contact_national_id',
        'contact_phone',
        'contact_email',
        'bank_account',
        'bank_shaba',
        'bank_id',
        'status',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(ContractFile::class);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
}
