<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataPribadi extends Model
{
    protected $table = 'data_pribadis';

    protected $fillable = [
        'user_id',
        'NUPTK',
        'NIDN',
        'Nama',
        'Jenis_Kelamin',
        'Tempat_Lahir',
        'Tanggal_Lahir',
        'NIP',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}