<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractFile extends Model
{
    protected $table = 'contract_files';
    protected $fillable = [
        'contract_id',
        'file_type',
        'file_path',
        'file_name',
        'file_size',
        'file_mime_type',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }
}
